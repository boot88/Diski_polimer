<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $lead;

    public ?array $photo;

    public function __construct(array $lead, ?array $photo = null)
    {
        $this->lead = $lead;
        $this->photo = $photo;
    }

    public function build()
    {
        $mail = $this->subject('Новая заявка с сайта НСК Макстар · Диски')
            ->view('emails.lead_request')
            ->with(['lead' => $this->lead]);

        if ($this->photo && is_file($this->photo['path'])) {
            $mail->attach($this->photo['path'], [
                'as' => $this->photo['name'],
                'mime' => $this->photo['mime'],
            ]);
        }

        return $mail;
    }
}
