<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CandidateJobNotify extends Mailable
{
    use Queueable, SerializesModels;

    protected $candidate;
    protected $company;
    protected $job;
    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($candidate, $company, $job, $status)
    {
        $this->candidate = $candidate;
        $this->company = $company;
        $this->job = $job;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Job Application Response')
            ->view('frontend.mail.application-mail')
            ->from('info@legendszone.com.np','Legends Zone')
            ->with(
                [
                    'candidate' => $this->candidate,
                    'company' => $this->company,
                    'job' => $this->job,
                    'status' => $this->status
                ]
            );
    }
}
