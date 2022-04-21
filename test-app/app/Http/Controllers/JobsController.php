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
        
        $command = "docker exec gtftk conda run -n pygtftk gtftk ologram -i mini_real.gtf.gz -c hg38.genome -p ENCFF112BHN_H3K4me3_K562_sub.bed -o test3.pdf 2>&1";
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
