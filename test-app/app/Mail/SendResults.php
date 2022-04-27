<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendResults extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $inputs;
    // protected $files_directory;
    protected $pdf_path;
    public function __construct($inputs,$pdf_path)
    {
        $this->inputs = $inputs;
        $this->pdf_path = $pdf_path; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('OLOGRAM Results')
                    ->view('emails.ologram-results')
                    ->with([
                        'gtf' => $this->inputs['gtf'],
                        'bed' => $this->inputs['bed'],
                        'chr' => $this->inputs['chr']
                    ])
                    ->attach($this->pdf_path);
    }
}
