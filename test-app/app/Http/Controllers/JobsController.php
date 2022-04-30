<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Jobs\ExecuteCommand;
use Session;
// use Illuminate\Support\Facades\Redirect;

class JobsController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function run_queued_job(Request $request)
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

        // Get all inputs as strings
        $inputs = [
            "gtf" => $request->file('gtf')->getClientOriginalName(),
            "bed" => $request->file('bed')->getClientOriginalName(),
            "chr" => $request->file('chr')->getClientOriginalName(),
            "email" => $request->email
        ];
       
        // Prepare date and directory variables
        $date = date("Ymd_His",time());
        $directory_name = $date.'-'.$inputs["gtf"].'-'.$inputs["bed"];

        // Prepare command to be executed
        $command = "sg docker -c '"."docker exec gtftk conda run -n pygtftk gtftk ologram -i ".$inputs["gtf"]." -c ".$inputs["chr"]." -p ".$inputs["bed"]." -o ".$directory_name." -k 8 2>&1"."'" ;
        
        // Send job to queue
        ExecuteCommand::dispatch($inputs,$command,$directory_name);

        // Return success message
        return $this->show_message();
    }

    public function show_message()
    {
        return redirect()->to('/main')->with('success', 'Job is running !');
    }

}
