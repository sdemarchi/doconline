<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSolicitudCodVinculacion extends Mailable{
    use Queueable, SerializesModels;
    protected $paciente;
    protected $mensaje;

    public function __construct($paciente)
    {
        $this->paciente = $paciente;
    }

    public function build()
    {
        return $this->subject('DocOnline - Envianos tu código de vinculación')
                       ->view('email.solicitar-cod-vinculacion')
                       ->with([
                        'paciente' => $this->paciente
                    ]);;
    }

}
