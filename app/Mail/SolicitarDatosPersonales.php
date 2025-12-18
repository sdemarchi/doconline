<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SolicitarDatosPersonales extends Mailable
{
    use Queueable, SerializesModels;

    protected $nombre;


    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Doc Online – Completá tus datos personales')
                    ->view('email.solicitar-registro-paciente')
                    ->with('nombre', $this->nombre);
    }
}
