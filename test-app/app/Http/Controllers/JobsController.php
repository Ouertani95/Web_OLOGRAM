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

    public function run_job ()
    {   
        // Add form information  to Jobs database using Job model
        Job::create([
            'email' => request('email'),
            'gtf' => request('gtf'),
            'bed' => request('bed'),
            'chr' => request('chr')
        ]);

        // Initialise variables
        $command = "who 2>&1";
        $output=null;
        $return_var=null;
        // Execute shell command in php
        exec($command, $output, $return_var);
        // Echo the output and the error code 
        echo "Returned with status $return_var and output:\n";
        print_r($output);
    
    }

    public function show_message()
    {
        return redirect()->to('/main')->with('success', 'Job is running !');
    }
}
