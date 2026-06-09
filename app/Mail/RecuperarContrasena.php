<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperarContrasena extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombreUsuario;
    public string $enlace;

    public function __construct(string $nombreUsuario, string $enlace)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->enlace        = $enlace;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recupera tu contraseña — Bitlyx Academy',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recuperar-contrasena',
            with: [
                'nombreUsuario' => $this->nombreUsuario,
                'enlace'        => $this->enlace,
            ]
        );
    }
}
