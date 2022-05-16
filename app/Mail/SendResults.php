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
    protected $uploaded_files_names;
    protected $results_paths;
    protected $results_link;
    public function __construct($uploaded_files_names,$results_paths,$results_link)
    {
        $this->uploaded_files_names = $uploaded_files_names;
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
                            ->markdown('emails.ologram-results')
                            ->with([
                                'uploaded_files_names' => $this->uploaded_files_names,
                                'link' => $this->results_link
                            ]);
        foreach ($this->results_paths as $path){
            $email_message->attach($path);
        }
        return $email_message;

    }
}
