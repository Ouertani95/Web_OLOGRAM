<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Session;
// use Illuminate\Support\Facades\Redirect;

class JobsController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function run_job (Request $request)
    {   
        // Validate form fields
        $validated = $request->validate([
            'email' => 'bail|required|email|max:100',
            'gtf' => 'required',
            'bed' => 'required',
            'chr' => 'required'
        ]);

        // Add form information  to Jobs database using Job model
        Job::create([
            'email' => request('email'),
            'gtf' => request('gtf'),
            'bed' => request('bed'),
            'chr' => request('chr')
        ]);
        
        // Get uploaded files
        $gtf = $request->file('gtf')->getClientOriginalName();
        $bed = $request->file('bed')->getClientOriginalName();
        $chr = $request->file('chr')->getClientOriginalName();

        // Prepare date and directory variables
        $date = date("Ymd_His",time());
        $directory_name = $date.'-'.$gtf.'-'.$bed;
        
        // Initialise command variables
        $command = "docker exec gtftk conda run -n pygtftk gtftk ologram -i $gtf -c $chr -p $bed -o $directory_name 2>&1" ;
        $output=null;
        $return_var=null;

        // Execute shell command in php
        exec($command, $output, $return_var);

        // Verify if errors occured during execution of command
        if ($return_var!== 0) {

            // If there are errors display the output of the error
            return back()->with('error','<pre>' . print_r($output,$return=true) . '</pre>');
        }
        
        // If no errors display result
        else{
            $result = $this->display_result($directory_name);
            return response()->file($result);
        }
    
    }

    public function show_message()
    {
        return redirect()->to('/main')->with('success', 'Job is running !');
    }

    public function display_result($directory)
    {
        $files = scandir("../pygtftk_results/".$directory);
        foreach ($files as $file){
            if (str_contains($file,"pdf")){
                $file_path = "../pygtftk_results/".$directory.'/'.$file;
                    return $file_path;
            }
        }
        
        
    }
}
