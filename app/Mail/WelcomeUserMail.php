<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $UserData;
    //numeros de reintentos en caso de error en el smtp
    public $tries = 3;
    public function __construct(array $UserData)
    {
        $this->UserData = $UserData;
    }

    /**
     * Get the message envelope.
     */
    public function build(): self
    {
        return $this->subject('¡Bienvenido a nuestra plataforma!')
            ->view('emails.welcome')
            ->with(['nombre' => $this->UserData['name']]); 
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
