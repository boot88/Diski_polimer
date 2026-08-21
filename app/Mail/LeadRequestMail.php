<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $lead;

    public function __construct(array $lead)
    {
        $this->lead = $lead;
    }

    public function build()
    {
        return $this->subject('Новая заявка с сайта НСК Макстар')
            ->view('emails.lead_request')
            ->with(['lead' => $this->lead]);
    }
}
