<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email;
    protected $contact_subject;
    protected $message;
    public function __construct($email,$contact_subject,$message)
    {
        $this->email = $email;
        $this->contact_subject = $contact_subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_contact_message = $this->subject("Contact message : $this->contact_subject")
                            ->markdown('emails.ologram-contact')
                            ->with([
                                'message' => $this->message,
                                'email' => $this->email
                            ]);
        return $email_contact_message;
    }
}
