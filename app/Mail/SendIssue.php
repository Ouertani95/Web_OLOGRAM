<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendIssue extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email;
    protected $title;
    protected $description;
    public function __construct($email,$title,$description)
    {
        $this->email = $email;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $email_issue_message = $this->subject("Issue : $this->title")
                            ->markdown('emails.ologram-issue')
                            ->with([
                                'description' => $this->description,
                                'email' => $this->email
                            ]);
        return $email_issue_message;
    }
}
