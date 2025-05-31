<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RainAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $city;

    public function __construct(string $city)
    {
        $this->city = $city;
    }

    public function build()
    {
        return $this->subject("Rain Alert for {$this->city}")
            ->view('emails.rain-alert');
    }
}
