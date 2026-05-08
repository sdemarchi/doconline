<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificarEmailPaciente extends Mailable
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
        return $this->subject('Doc Online – Validación de Email')
            ->view('email.verificar-email')
            ->with([
                'nombre' => $this->nombre,
                'url' => $this->url
            ]);
    }
}
