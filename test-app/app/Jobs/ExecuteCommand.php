<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
    public function __construct($command,$directory)
    {
        $this->command = $command;
        $this->directory = $directory;
        var_dump($this->directory);
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
            echo ("success madafaka !!! ");
        }
    }

    public function display_result()
    {
        $files = scandir("../pygtftk_results/".$this->directory);
        foreach ($files as $file){
            if (str_contains($file,"pdf")){
                $file_path = "../pygtftk_results/".$this->directory.'/'.$file;
                    return $file_path;
            }
        }
        
        
    }
}
