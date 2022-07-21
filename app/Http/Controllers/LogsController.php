<?php

namespace App\Http\Controllers;

use App\Mail\SendError;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class LogsController extends Controller
{
    public function display_log($id)
    {
        // Get the status of the request using $id
        $status_request =  Job::where('location_id', $id)
                        ->get()
                        ->pluck('status');
        // Catch error if id does not exist in database and return 404 error
        try {
            $status = $status_request[0];
        } catch (\Throwable $e) {
            abort(404);
        }
        

        // Get all the validated arguments from the json file
        $recovered_args = file_get_contents("../ologram_results/$id/validated.json");
        $recovered_args_array = json_decode($recovered_args,true);

        // Extract caseId used to launch the request
        $case = $recovered_args_array["caseId"];

        // Prepare and filter log file if it exists 
        $log_file = "../ologram_results/$id/ologram.log";
        if(file_exists($log_file)){
            $log_content_string = file_get_contents($log_file);
            $log_content_array = explode("\n",$log_content_string );
            $words_list = array("python","conda","docker","threads");
            foreach($log_content_array as $index => $line) {
                if (str_contains($line,$id)){
                    $line = str_replace("$id/","",$line);
                    $log_content_array[$index] = $line;
                }
                if (str_contains($line,"-WARNING")){
                    $line = str_replace("-WARNING","",$line);
                    $log_content_array[$index] = $line;
                }
                foreach ($words_list as $word){
                    if(str_contains($line,$word)) {
                        unset($log_content_array[$index]);
                        break;
                    }
                }
                
            }
        }
        else{
            $log_content_string = "";
            $log_content_array = array("Loading ...") ;
        }


        // Prepare message according to status
        if ($status === "queued") {
            session()->now('queue','Your request will start shortly, thank you for your patience !');
        }
        elseif($status === "running") {
            session()->now('running','Your request is running ... ');
        }
        elseif($status === "success"){

            // Get current app URL (localhost or IP ,...)
            $current_address = env("APP_URL");

            // Create filtered log file
            $filtered_log_content_string = implode("\n",$log_content_array);
            file_put_contents("../ologram_results/$id/ologram_request.log",$filtered_log_content_string);
            $log_link = "$current_address/download/log/$id" ;
            
            // Prepare results link
            $results_directory = "../ologram_results/$id/";
            $available_files = scandir($results_directory);
            foreach ($available_files as $file) {
                if (str_ends_with($file,".tsv")){
                    $dash_link = "$current_address/results/$id/$file";
                    $dash_link = str_replace("../ologram_results/","",$dash_link);
                    
                }
            }

            // Prepare file download buttons if Ensembl GTF or CHR options are chosen
            if (array_key_exists("ens_gtf",$recovered_args_array)&&array_key_exists("ens_chr",$recovered_args_array)) {
                $download_link = $current_address."/download/ens/".$recovered_args_array["ens_gtf"] ;
                session()->now('download_gtf_chr',$download_link);
            }
            elseif (array_key_exists("ens_gtf",$recovered_args_array)){
                $download_link = $current_address."/download/ens/".$recovered_args_array["ens_gtf"] ;
                session()->now('download_gtf',$download_link);
            }
            elseif (array_key_exists("ens_chr",$recovered_args_array)) {
                $download_link = $current_address."/download/ens/".$recovered_args_array["ens_chr"]."/chr" ;
                session()->now('download_chr',$download_link);
            }

            // Prepare request ologram command
            $command = file_get_contents("../ologram_results/$id/command.txt");

            // Return view with command, results link and log
            session()->now('success', $dash_link);
            return view("live-feed")->with(['file' => $log_content_array
                                            ,'command' => $command
                                            ,'log' => $log_link]);
        }
        elseif($status === "error"){
            $msg = "Your request failed with the following error(s): <br>";
            foreach ($log_content_array as $line){
                if ((str_contains($line ,"ERROR"))){
                    $msg .= "$line<br>";
                }
                
            }
            $msg .= "Please reupload your files with the appropriate changes.";
            return redirect()->to("/")->withInput($recovered_args_array)->with([
                                                                                'error'=>$msg,
                                                                                $case."_show"=>true
                                                                            ]);
        }

        // Show the page with the corresponding message
        return view("live-feed")->with(['file' => $log_content_array]);
    }
}
