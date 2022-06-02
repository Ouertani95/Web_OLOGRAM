<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendError extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $error_message;
    public function __construct($error_message)
    {
        $this->error_message = $error_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_message = $this->subject('OLOGRAM Error')
                            ->markdown('emails.ologram-error')
                            ->with([
                                'error_message' => $this->error_message,
                            ]);
        return $email_message;
    }
}
