<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResults;
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
        var_dump($this->command);
        $results_directory = base_path("pygtftk_results/".$this->directory);

        $nb_uploaded_files = count($this->uploaded_files_paths);
        $nb_current_files = count(glob(base_path("pygtftk_results/$this->directory/*")));
        
        // Initialise output variables
        $output=null;
        $return_var=0;
        
        // Check if directory already exists and new files have been created (meaning command has already been launched before)
        if ($nb_current_files === $nb_uploaded_files){
            // Execute shell command in php
            exec($this->command, $output, $return_var);
        }

        // Verify if errors occured during execution of command
        if ($return_var!== 0) {

            $output_string = implode("\n",$output);

            // If there are errors display the output of the error
            var_dump($output_string);

            // Delete uploaded files and results directory
            // Storage::delete(array_values($this->uploaded_files_paths));
            // Storage::deleteDirectory($this->directory);
        }
        
        // If no errors send the results
        else{
             // Get the result files
            $results_paths = $this->get_results_paths($results_directory);

            // Run the Shiny app with the results 
            $tsv_path = $this->get_tsv_path($results_paths);
            // $shiny_command = "sg docker -c 'nohup Rscript app/Shiny/app.R'";
            // exec($shiny_command,$shiny_output);
            // $file_name = end($shiny_output);

            $results_link = "http://localhost:7775/?file=$tsv_path";
        
            // Send email with link and attachements
            
            Mail::to($this->email)
                ->send(new SendResults($this->uploaded_files_names,$results_paths,$results_link));

            // Delete uploaded files and results directory
            Storage::delete(array_values($this->uploaded_files_paths));

            // Print success message
            echo ("success !!! ");
        }   
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
                $path = str_replace("/var/www/html/","",$path);
                return $path;
            }
        }
    }
}
