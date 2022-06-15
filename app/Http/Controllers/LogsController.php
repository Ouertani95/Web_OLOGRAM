<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function display_log($id)
    {
        $file_name = "../pygtftk_results/$id/ologram.log";
        if(file_exists($file_name)){
            $file_content = file_get_contents($file_name);
            $file_content = explode("\n",$file_content);
        }
        else{
            $file_content = array("File not Found") ;
        }

        return view("live-feed")->with(['file' => $file_content]);
    }
}
