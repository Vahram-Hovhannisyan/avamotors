<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $verifyUrl,
        public string $userName = ''
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Подтвердите e-mail — AVAMotors');
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth.emails.verify-email',
            with: [
                'verifyUrl' => $this->verifyUrl,
                'userName'  => $this->userName,
            ]
        );
    }
}
