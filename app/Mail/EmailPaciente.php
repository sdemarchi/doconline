<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailPaciente extends Mailable{
    use Queueable, SerializesModels;
    protected $paciente;
    protected $mensaje;

    public function __construct($paciente,$mensaje)
    {
        $this->paciente = $paciente;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject('DocOnline - Información de su trámite')
                       ->view('email.email-paciente')
                       ->with([
                        'paciente' => $this->paciente,
                        'mensaje' => $this->mensaje
                    ]);;
    }

}
