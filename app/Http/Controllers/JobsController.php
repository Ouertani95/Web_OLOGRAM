<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCase;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Jobs\ExecuteCommand;
use App\Mail\SendLive;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    public function index()
    {
        exec("rsync -av --list-only rsync://ftp.ensembl.org/ensembl/pub/current_gtf/ |awk '{print $5}' |grep 'gtf.gz' |grep -v 'abinitio' |grep -v '\.chr\.'",$gtf_list);
        // dd($gtf_list);

        $exploded_gtf_list = array();

        foreach ($gtf_list as $gtf){
            $gtf_kv = explode("/",$gtf);
            if (!array_key_exists($gtf_kv[0],$exploded_gtf_list)){
                $exploded_gtf_list[$gtf_kv[0]] = array();
                array_push($exploded_gtf_list[$gtf_kv[0]],$gtf_kv[1]);
            }
            else{
                array_push($exploded_gtf_list[$gtf_kv[0]],$gtf_kv[1]);
            }
        }

        return view('main')->with(['links' => $exploded_gtf_list]);
    }

    public function run_queued_job(ValidateCase $request)
    {   
        // Add request object to Controller as attribute
        $this->request = $request;

        // Create New directory
        $date = date("Ymd_His",time());
        $random_str = Str::random(40);
        $directory_name = $date.'-'.$random_str;
        Storage::makeDirectory($directory_name);

        // Save validated input fields in json format to be extracted later
        $validated_args = json_encode($this->request->validated());
        file_put_contents("../pygtftk_results/$directory_name/validated.json",$validated_args);

        // Verify if Ensembl GTF exists on server and download it if not 
        if (array_key_exists("ens_gtf",$request->validated())){

            $file_fields= ["bed","chr","mbed","bedin","bedex"];
            
            $ensembl_link = $request->input("ens_gtf");
            $ensembl_link_trunc = str_replace("http://ftp.ensembl.org/pub/current_gtf/","",$ensembl_link);
            $species = explode("/",$ensembl_link_trunc)[0];
            $gtf_name = explode("/",$ensembl_link_trunc)[1];

            // Save path to requested Ensembl gtf file
            $this->ensembl_gtf = "Ensembl_GTF/$species/$gtf_name";

            if (!Storage::exists("/Ensembl_GTF/$species")){
                Storage::makeDirectory("/Ensembl_GTF/$species");
                exec("wget $ensembl_link -O ../pygtftk_results/Ensembl_GTF/$species/$gtf_name 2>&1");
            }
            elseif (!Storage::exists("/Ensembl_GTF/$species/$gtf_name")){
                exec("wget $ensembl_link -O ../pygtftk_results/Ensembl_GTF/$species/$gtf_name 2>&1");
            }

        }
        else{
            $file_fields= ["gtf","bed","chr","mbed","bedin","bedex"];
        }


        // Function to remove special chars from file names (special chars cause errors in command execution)
        function remove_special_chars($my_string){
            $special_chars = '[@_!#$%^&*()<>?/|}{~:]';
            $special_chars = str_split($special_chars);
            foreach ($special_chars as $char){
                if (str_contains($my_string,$char)){
                    $my_string = str_replace($char,"",$my_string);
                }
            }
            return $my_string;
        }

        // Upload available files and save their paths and names
        $uploaded_files_names = array();
        $uploaded_files_paths = array();

        foreach($file_fields as $file)
        {
            if($request->hasfile($file))
            {
                if ($file === "mbed"){
                    $uploaded_files_names["mbed"] = array();
                    $uploaded_files_paths["mbed"] = array();
                    $mbed_files = array_values($request->file($file));
                    foreach($mbed_files as $mbed_file){
                        $name = $mbed_file->getClientOriginalName();
                        $name = remove_special_chars($name);
                        Storage::putFileAs("/$directory_name",$mbed_file,$name);
                        array_push($uploaded_files_paths[$file],"$directory_name/".$name);
                        array_push($uploaded_files_names[$file],$name);
                    }
                }
                else{
                    $name = $request->file($file)->getClientOriginalName();
                    $name = remove_special_chars($name);
                    Storage::putFileAs("/$directory_name",$request->file($file),$name);
                    $uploaded_files_paths[$file] = "$directory_name/".$name;
                    $uploaded_files_names[$file] = $name;
                }
                
            }

        }

        // Add Ensembl GTF path 
        if (array_key_exists("ens_gtf",$request->validated())){
            $uploaded_files_paths["ens_gtf"] =  $this->ensembl_gtf;
        }

        // Build command for gtftk
        $command = $this->build_command($directory_name,$uploaded_files_paths);

        // Filter command to send to user in case of succees
        $filtered_command = $command ;
        $to_remove = ["-L $directory_name/arguments.log > pygtftk_results/$directory_name/ologram.log 2>&1",
                    "$directory_name/",
                    "docker exec -t gtftk conda run --no-capture-output -n pygtftk ",
                    " -o $directory_name"];
        foreach ($to_remove as $command_substring){
            $filtered_command = str_replace($command_substring,"",$filtered_command);
        }

        // Get used command inside a file to be extracted later
        file_put_contents("../pygtftk_results/$directory_name/command.txt",$filtered_command);

        // Send job to queue
        ExecuteCommand::dispatch($uploaded_files_paths,$uploaded_files_names,$request->email,$command,$directory_name);
        
         // // Add form information  to Jobs database using Job model
         Job::create([
            'email' => request('email'),
            'command' => $command,
            'location_id' => "$directory_name",
            'status' => "queued"
        ]);
        
        // Prepare live-feed link
        $current_address = env("APP_URL");
        $feed_link = "/live-feed/$directory_name";
        $full_feed_link = $current_address.$feed_link;

        // Mail live-feed link
        Mail::to($request->email)
                ->send(new SendLive($full_feed_link));

        // Return success message
        return redirect()->to("$feed_link");
    }
    
    public function build_command($directory_name,$uploaded_files_paths)
    {   
        // Prepare basic command structure
        $basic_command = "docker exec -t gtftk conda run --no-capture-output -n pygtftk gtftk ologram ";

        // Get validated args from request
        $validated_args = $this->request->validated();

        // Verify if an Ensembl GTF is selected and remove GTF to upload if selected at the same time
        if (array_key_exists("ens_gtf",$validated_args)){
            if (array_key_exists("ens_gtf",$validated_args)){
                unset($validated_args["gtf"]);
            }
        }

        // Add case specific argument
        if ($validated_args["caseId"]==="case2"){
            $basic_command = $basic_command." -n ";
        }
        elseif($validated_args["caseId"]==="case3"){
            $basic_command = $basic_command." -z ";
        }
        elseif($validated_args["caseId"]==="case4"){
            $basic_command = $basic_command." -z --more-bed-multiple-overlap ";
        }
        // Prepare check box type arguments
        $check_args = [
            "fcg" => " -f ",
            "fcp" => " -w ",
            "fcmb" => " -q ",
            "exact" => " -ex "
        ];
        // Prepare file input type arguments
        $file_args = [
            "gtf" => " -i ",
            "chr" => " -c ",
            "bed" => " -p ",
            "mbed" => " -b ",
            "bedin" => " -bi ",
            "bedex" => " -e ",
            "ens_gtf" => " -i "
        ];
        // Prepare text input type arguments
        $text_args = [
            "mbedl" => " -l ",
            "keys" => " -m ",
            "ups" => " -u ",
            "dns" => " -d ",
            "max" => " -monc "
        ];
        // Build the rest of the command
        foreach (array_keys($validated_args)  as $arg){

            if (array_key_exists($arg,$check_args)){
                $basic_command = $basic_command.$check_args[$arg];
            }
            elseif (array_key_exists($arg,$file_args)){
                
                $basic_command = $basic_command.$file_args[$arg];
                if($arg === "mbed"){
                    $files = $uploaded_files_paths[$arg];
                    foreach ($files as $file){
                        $basic_command = $basic_command." $file ";
                    }
                }
                else{
                    $file = $uploaded_files_paths[$arg];
                    $basic_command = $basic_command.$file;
                }
            }
            elseif (array_key_exists($arg,$text_args)){
                $text = $this->request->input($arg);
                $basic_command = $basic_command.$text_args[$arg].$text;
            }
        }

        // Add final arguments to complete the command
        $basic_command = $basic_command." -o $directory_name -x -V 0 -k 8 -L $directory_name/arguments.log > pygtftk_results/$directory_name/ologram.log 2>&1";

        return $basic_command;
    }

}
