<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Paciente;
use App\Models\PacientePatologia;

class FormularioCompleto extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    protected $paciente;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $patologias = PacientePatologia::where('idpaciente',$this->paciente->idpaciente);
        return $this->subject('Doconline - Formulario Completo')
                    ->view('email.formulario-completo')
                    ->with([
                        'paciente' => $this->paciente,
                        'patologias' => $patologias    
                    ]);
    }
}
