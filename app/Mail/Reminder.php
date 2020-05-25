<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $emailMessage;

    public $subject;

    public $sender='it2.0group4user@gmail.com';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $emailMessage, string $subject)
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
        return $this->view('mail.reminder')
            ->from($this->sender)
            ->subject($this->subject);
    }
}
