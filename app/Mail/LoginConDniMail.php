<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginConDniMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre;
    protected $url;

    public function __construct($nombre, $url)
    {
        $this->nombre = $nombre;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Doc Online – Iniciar sesión')
            ->view('email.login-dni')
            ->with([
                'nombre' => $this->nombre,
                'url' => $this->url
            ]);
    }
}
