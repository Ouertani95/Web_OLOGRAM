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
    public $inputs;

    public function __construct($inputs,$command,$directory)
    {
        $this->inputs = $inputs;
        $this->command = $command;
        $this->directory = $directory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {   
        $results_directory = base_path("pygtftk_results/".$this->directory);
        
        // Initialise output variables
        $output=null;
        $return_var=0;

        // Check if directory already exists (meaning command has already been launched before)
        if (!file_exists($results_directory)){
            // Execute shell command in php
            exec($this->command, $output, $return_var);
        }

        // Verify if errors occured during execution of command
        if ($return_var!== 0) {
            $output_string = implode("\n",$output);
            // If there are errors display the output of the error
            var_dump($output_string);
            Storage::disk('local')->delete([$this->inputs['gtf'],$this->inputs['bed'],$this->inputs['chr']]);
        }
        
        // If no errors send the results
        else{
            
            // Get the result files and send email with attachements
            $results_paths = $this->get_results_paths($results_directory);
            Mail::to($this->inputs["email"])
                ->send(new SendResults($this->inputs,$results_paths));
                
            // Run the Shiny app with the results 
            $tsv_path = $this->get_tsv_path($results_paths);
            $shiny_command = "sg docker -c 'nohup Rscript app/Shiny/app.R -i $tsv_path >> app/Shiny/shiny.log 2>&1 &'";
            exec($shiny_command);

            // Print success message
            echo ("success !!! ");

            // Delete uploaded files and results directory
            Storage::delete([$this->inputs['gtf'],$this->inputs['bed'],$this->inputs['chr']]);
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
                return $path;
            }
        }
    }
}
