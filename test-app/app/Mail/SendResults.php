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
    protected $results_paths;
    protected $results_link;
    public function __construct($inputs,$results_paths,$results_link)
    {
        $this->inputs = $inputs;
        $this->results_paths = $results_paths;
        $this->results_link = $results_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_message = $this->subject('OLOGRAM Results')
                            ->view('emails.ologram-results')
                            ->with([
                                'gtf' => $this->inputs['gtf'],
                                'bed' => $this->inputs['bed'],
                                'chr' => $this->inputs['chr'],
                                'link' => $this->results_link
                            ]);
        foreach ($this->results_paths as $path){
            $email_message->attach($path);
        }
        return $email_message;

    }
}
