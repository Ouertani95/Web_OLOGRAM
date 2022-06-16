<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function display_log($id)
    {
        $file_name = "../pygtftk_results/$id/ologram.log";
        if(file_exists($file_name)){
            $file_content_string = file_get_contents($file_name);
            $file_content_array = explode("\n",$file_content_string );
        }
        else{
            $file_content_string = "";
            $file_content_array = array("File not Found") ;
        }

        if(str_contains($file_content_string,"successfully")){
            $results_directory = "../pygtftk_results/$id/";
            $available_files = scandir($results_directory);
            foreach ($available_files as $file) {
                if (str_ends_with($file,".tsv")){
                    $current_address = env("APP_URL");
                    $dash_link = "$current_address:7775/?file=".$results_directory.$file;
                    $dash_link = str_replace("..","",$dash_link);
                    // dd($dash_link);
                }
            }
            session()->now('success', $dash_link);
            return view("live-feed")->with(['file' => $file_content_array]);
        }

        if(str_contains($file_content_string,"stopped")){
            session()->now('error', "Your request failed ! Please check the below log or your email for the exact error!");
            return view("live-feed")->with(['file' => $file_content_array]);
        }

        return view("live-feed")->with(['file' => $file_content_array]);
    }
}
