<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $verifyUrl,
        public string $userName = '',
        public $locale = 'hy'
    ) {}

    public function envelope(): Envelope
    {
        // Устанавливаем язык для перевода
        App::setLocale($this->locale);

        // Получаем переведенный заголовок
        $subject = Lang::get('emails.verify_email.title', [], $this->locale);

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth.emails.verify-email',
            with: [
                'verifyUrl' => $this->verifyUrl,
                'userName'  => $this->userName,
                'locale'    => $this->locale,
            ]
        );
    }
}
