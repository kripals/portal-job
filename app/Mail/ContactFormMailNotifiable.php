<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormMailNotifiable extends Mailable
{
    use Queueable, SerializesModels;

    protected $inquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->inquiry['email_address'], $this->inquiry['full_name'])
            ->view('frontend.mail.contact-inquiry')
            ->subject($this->inquiry['subject'])
            ->with($this->inquiry);
    }
}
