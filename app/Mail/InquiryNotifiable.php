<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InquiryNotifiable extends Mailable
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
        return $this->from($this->inquiry['email'], $this->inquiry['name'])
            ->view('frontend.mail.quick-inquiry')
            ->subject('Inquiry Email')
            ->with(['inquiry_message' => $this->inquiry['message']]);

    }
}
