<?php

namespace App\Http\Controllers;

use App\Mail\SendError;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LogsController extends Controller
{
    public function display_log($id)
    {
        // Get the status of the request using $id
        $status_request =  Job::where('location_id', $id)
                        ->get()
                        ->pluck('status');
        $status = $status_request[0];

        // Get all the validated arguments from the json file
        $recovered_args = file_get_contents("../pygtftk_results/$id/validated.json");
        $recovered_args_array = json_decode($recovered_args,true);

        // Extract caseId used to launch the request
        $case = $recovered_args_array["caseId"];

        // Prepare and filter log file if it exists 
        $file_name = "../pygtftk_results/$id/ologram.log";

        if(file_exists($file_name)){
            $file_content_string = file_get_contents($file_name);
            $file_content_array = explode("\n",$file_content_string );
            $words_list = array("python","conda","docker","threads");
            foreach($file_content_array as $index => $line) {
                if (str_contains($line,$id)){
                    $line = str_replace("$id/","",$line);
                    $file_content_array[$index] = $line;
                }
                if (str_contains($line,"-WARNING")){
                    $line = str_replace("-WARNING","",$line);
                    $file_content_array[$index] = $line;
                }
                foreach ($words_list as $word){
                    if(str_contains($line,$word)) {
                        unset($file_content_array[$index]);
                        break;
                    }
                }
                
            }
        }
        else{
            $file_content_string = "";
            $file_content_array = array("Loading ...") ;
        }


        // Prepare message according to status
        if ($status === "queued") {
            session()->now('queue','Your request will start shortly, thank you for your patience !');
        }
        elseif($status === "running") {
            session()->now('running','Your request is running ... ');
        }
        elseif($status === "success"){
            $results_directory = "../pygtftk_results/$id/";
            $available_files = scandir($results_directory);
            foreach ($available_files as $file) {
                if (str_ends_with($file,".tsv")){
                    $current_address = env("APP_URL");
                    $dash_link = "$current_address:7775/?file=".$results_directory.$file;
                    $dash_link = str_replace("..","",$dash_link);
                }
            }
            $command = file_get_contents("../pygtftk_results/$id/command.txt");
            session()->now('success', $dash_link);
            return view("live-feed")->with(['file' => $file_content_array,'command'=>$command]);
        }
        elseif($status === "error"){
            $msg = "Your request failed with the following error(s): <br>";
            foreach ($file_content_array as $line){
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
        return view("live-feed")->with(['file' => $file_content_array]);
    }
}
