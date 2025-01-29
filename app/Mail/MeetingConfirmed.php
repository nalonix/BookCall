<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $meetingLink;

    /**
     * Create a new message instance.
     *
     * @param string $meetingLink
     */
    public function __construct($meetingLink)
    {
        $this->meetingLink = $meetingLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Meeting Has Been Confirmed')
            ->view('emails.meeting_confirmed'); // Blade view for the email
    }
}
