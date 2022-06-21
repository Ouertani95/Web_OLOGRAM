<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLive extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $feed_link;
    public function __construct($feed_link)
    {
        $this->feed_link = $feed_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_message = $this->subject('OLOGRAM live-feed')
                            ->markdown('emails.ologram-live-feed')
                            ->with([
                                'link' => $this->feed_link
                            ]);
        return $email_message;
    }
}
