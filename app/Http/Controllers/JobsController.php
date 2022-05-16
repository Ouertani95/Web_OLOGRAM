<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCase;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Jobs\ExecuteCommand;
use Illuminate\Support\Facades\Storage;
use App\Rules\ValidateGTF;
use App\Rules\ValidateBED;

class JobsController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function run_queued_job(ValidateCase $request)
    {
        dd($request->file("mbed"));
        // dd ($request->file("gtf")->getContent());
        
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

        // Upload files to server
        Storage::putFileAs("",$request->file('gtf'),$inputs['gtf']);
        Storage::putFileAs("",$request->file('bed'),$inputs['bed']);
        Storage::putFileAs("",$request->file('chr'),$inputs['chr']);
       
        // Prepare date and directory variables
        $date = date("Ymd_His",time());
        $directory_name = $date.'-'.$inputs["gtf"].'-'.$inputs["bed"];

        // Prepare command to be executed
        $command = "sg docker -c '"."docker exec web_ologram_gtftk_1 conda run -n pygtftk gtftk ologram -i ".$inputs["gtf"]." -c ".$inputs["chr"]." -p ".$inputs["bed"]." -o ".$directory_name." -k 8 2>&1"."'" ;
        
        // Send job to queue
        ExecuteCommand::dispatch($inputs,$command,$directory_name);

        // Return success message
        return $this->show_message();
    }

    public function show_message()
    {
        return redirect()->to('/')->with('success', 'Job is running !');
    }
    
    public function build_command()
    {
        $args = [
            "fcg" => " -f ",
            "fcp" => " -w ",
            "fcmb" => " -q ",
            "dfq" => " -y ",
            "cf" => " -r ",
            "hu" => " -a ",
            "pvt" => " -g ",
            "gtf" => " -i ",
            "chr" => " -c ",
            "bed" => " -p ",
            "mbed" => " -b ",
            "mbedl" => " -l ",
            "bedin" => " -bi ",
            "bedex" => " -e ",
            "ups" => " -u ",
            "dns" => " -d ",
            "srtf" => " -j ",
            "keys" => " -m ",
            "exact" => " -ex ",
            "max" => " -monc "
        ];

        
    }

}
