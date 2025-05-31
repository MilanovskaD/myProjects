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

    public string $email;
    public string $city;

    public function __construct(string $email, string $city)
    {
        $this->email = $email;
        $this->city = $city;

    }

    public function build()
    {
        \URL::forceRootUrl('http://127.0.0.1:8000');

        $unsubscribeToken = hash('sha256', $this->email . config('app.key'));
        $unsubscribeLink = route('unsubscribe', [
            'email' => $this->email,
            'token' => $unsubscribeToken,
            'city' => $this->city
        ]);

        return $this->subject("🌧️ Rain Alert for {$this->city}")
            ->view('emails.rain-alert', [
                'unsubscribeLink' => route('unsubscribe', [
                    'email' => $this->email,
                    'token' => $unsubscribeToken,
                    'city' => $this->city
                ])
            ])
            ->withSwiftMessage(function ($message) use ($unsubscribeLink) {

                $message->getHeaders()->addTextHeader(
                    'List-Unsubscribe',
                    "<$unsubscribeLink>"
                );
            });
    }
}
