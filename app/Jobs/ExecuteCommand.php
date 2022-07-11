<?php

namespace App\Jobs;

use App\Mail\SendError;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResults;
use App\Models\Job;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExecuteCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $command;
    public $directory;
    public $email;
    public $uploaded_files_paths;
    public $uploaded_files_names;

    public function __construct($uploaded_files_paths,$uploaded_files_names,$email,$command,$directory)
    {
        $this->uploaded_files_paths = $uploaded_files_paths;
        $this->email = $email;
        $this->command = $command;
        $this->directory = $directory;
        $this->uploaded_files_names = $uploaded_files_names;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {   
        Job::where('location_id', $this->directory)
            ->update(['status' => "running"]);

        // Prepare output results directory
        $results_directory = base_path("pygtftk_results/".$this->directory);

        // Initialise output variables
        $return_var=0;
        
        // Check if log file already in results directory (meaning command has already been launched before)
        $current_files = scandir($results_directory);

        if (! in_array("ologram.log",$current_files) ){
            // Execute shell command in php
            system($this->command, $return_var);
        }

        exec("cat $results_directory/ologram.log",$log_content);
        $log_content = implode("\n",$log_content);

        // remove ensemble gtf value and chr from paths if ens_gtf is chosen
        if (array_key_exists("ens_gtf",$this->uploaded_files_paths)){
            unset($this->uploaded_files_paths["ens_gtf"]);
        }
        if (array_key_exists("ens_chr",$this->uploaded_files_paths)){
            unset($this->uploaded_files_paths["ens_chr"]);
        }

        // Verify if errors occured during execution of command
        if (($return_var !== 0)||(str_contains($log_content,"ERROR"))) {

            echo ("I'm in error\n");

            // Modify job status
            Job::where('location_id', $this->directory)
                ->update(['status' => "error"]);

            // Delete uploaded files 
            $uploaded_files = array_values($this->uploaded_files_paths);
            foreach ($uploaded_files as $up_file){
                Storage::delete($up_file);
            }
            
            // Execute shell command to get error message
            exec("cat pygtftk_results/$this->directory/ologram.log |grep 'ERROR\|error' |grep -v 'conda\|email\|python\|docker'",$error_check);

            // Transform errors to string
            $error_check = implode("\n",$error_check);

            // remove directory name from all the lines
            if (str_contains($error_check,$this->directory)){
                echo ("Found directory : deleting it from log \n");
                // Remove directory path from error message
                $error_check = str_replace("$this->directory/","",$error_check);
            }

            // Send error email
            Mail::to($this->email)
                ->send(new SendError($error_check));
            
        }
        
        // If no errors send the results
        else{

            echo ("I'm not in error\n");

            // Modify job status
            Job::where('location_id', $this->directory)
                ->update(['status' => "success"]);

            // Get the result files
            $results_paths = $this->get_results_paths($results_directory);

            // Build file link
            $tsv_path = $this->get_tsv_path($results_paths);
            $tsv_path = str_replace("/pygtftk_results/","",$tsv_path);
            $current_address = env("APP_URL");
            $results_link = "$current_address/results/$tsv_path";

            echo ($results_link."\n");
        
            // Send email with link and file names
            Mail::to($this->email)
                ->send(new SendResults($this->uploaded_files_names,$results_link));
            }

            // Delete uploaded files 
            $uploaded_files = array_values($this->uploaded_files_paths);
            foreach ($uploaded_files as $up_file){
                Storage::delete($up_file);
            }
            

            // Print success message
            echo ("success !!! \n");
    }

    public function get_results_paths($results_directory)
    {   
        $results_paths = [];
        $available_files = scandir($results_directory);
        foreach ($available_files as $file){
            if (! in_array($file,array(".",".."))){
                $file_path = $results_directory.'/'.$file;
                array_push($results_paths,$file_path);
            }
        }
        return $results_paths;
        
    }

    public function get_tsv_path($results_paths)
    {
        foreach ($results_paths as $path){
            if (str_ends_with($path,".tsv")) {
                $path = str_replace("/var/www/html","",$path);
                return $path;
            }
        }
    }
}
