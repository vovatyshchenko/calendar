<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    public $emailMessage;

    public $subject;

    public $sender;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $emailMessage, string $subject)
    {
        $this->emailMessage = $emailMessage;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.message')
            ->subject($this->subject);
    }
}
