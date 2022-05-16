<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCase;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Jobs\ExecuteCommand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    public function index()
    {
        return view('main');
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

        // Upload available files
        $file_fields= ["gtf","bed","chr","mbed","bedin","bedex"];
        foreach($file_fields as $file)
        {
            if($request->hasfile($file))
            {
                $name = $request->file($file)->getClientOriginalName();
                Storage::putFileAs("/$directory_name",$request->file($file),$name);
                $uploaded_files_paths[$file] = "$directory_name/".$name;
                $uploaded_files_names[$file] = $name;
            }
        }

        // Build command for gtftk
        $command = $this->build_command($directory_name,$uploaded_files_paths);

        // // Add form information  to Jobs database using Job model
        Job::create([
            'email' => request('email'),
            'command' => $command
        ]);

        // Send job to queue
        ExecuteCommand::dispatch($uploaded_files_paths,$uploaded_files_names,$request->email,$command,$directory_name);

        // Return success message
        return $this->show_message();
    }

    public function show_message()
    {
        return redirect()->to('/')->with('success', 'Job is running !');
    }
    
    public function build_command($directory_name,$uploaded_files_paths)
    {   
        $basic_command = "sg docker -c '"."docker exec web_ologram_gtftk_1 conda run -n pygtftk gtftk ologram ";

        $validated_args = $this->request->validated();

        if ($validated_args["caseId"]==="case2"){
            $basic_command = $basic_command." -n ";
        }
        elseif($validated_args["caseId"]==="case3"){
            $basic_command = $basic_command." -z ";
        }
        elseif($validated_args["caseId"]==="case4"){
            $basic_command = $basic_command." -z ";
        }

        $check_args = [
            "fcg" => " -f ",
            "fcp" => " -w ",
            "fcmb" => " -q ",
            "dfq" => " -y ",
            "cf" => " -r ",
            "hu" => " -a ",
            "pvt" => " -g ",
            "exact" => " -ex "
        ];

        $file_args = [
            "gtf" => " -i ",
            "chr" => " -c ",
            "bed" => " -p ",
            "mbed" => " -b ",
            "bedin" => " -bi ",
            "bedex" => " -e "
        ];

        $text_args = [
            "mbedl" => " -l ",
            "keys" => " -m ",
            "ups" => " -u ",
            "dns" => " -d ",
            "max" => " -monc ",
            "srtf" => " -j ",
        ];
        
        foreach (array_keys($validated_args)  as $arg){

            if (array_key_exists($arg,$check_args)){
                $basic_command = $basic_command.$check_args[$arg];
            }
            elseif (array_key_exists($arg,$file_args)){
                $file = $uploaded_files_paths[$arg];
                $basic_command = $basic_command.$file_args[$arg].$file;
            }
            elseif (array_key_exists($arg,$text_args)){
                $text = $this->request->input($arg);
                $basic_command = $basic_command.$text_args[$arg].$text;
            }
        }

        $basic_command = $basic_command." -o $directory_name "." -k 8 2>&1 '";

        return $basic_command;
    }

}
