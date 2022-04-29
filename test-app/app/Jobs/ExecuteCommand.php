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


class ExecuteCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $command;
    protected $directory;
    protected $inputs;
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
        $output=null;
        $return_var=null;

        // Execute shell command in php
        exec($this->command, $output, $return_var);

        // Verify if errors occured during execution of command
        if ($return_var!== 0) {
            $output_string = implode("\n",$output);
            // If there are errors display the output of the error
            var_dump($output_string);
        }
        
        // If no errors display result
        else{
            
            $results_directory = base_path("pygtftk_results/".$this->directory);
            $results_paths = $this->get_results_paths($results_directory);
            Mail::to($this->inputs["email"])
                ->send(new SendResults($this->inputs,$results_paths));
                
            // Run the Shiny app with the results 

            // $tsv_path = $this->get_tsv_path($results_paths);
            // $shiny_command = "Rscript app/Shiny/app.R -i $tsv_path &";
            // exec($shiny_command);

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
                return $path;
            }
        }
    }
}
