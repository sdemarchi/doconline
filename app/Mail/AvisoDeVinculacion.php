<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoDeVinculacion extends Mailable{
    use Queueable, SerializesModels;
    protected $paciente;
    protected $datosTramite;

    public function __construct($paciente)
    {
        $this->paciente = $paciente;
        $this->datosTramite =$this->parsearDatosTramite($paciente->datos_tramite);
    }

    public function build()
    {
        return $this->subject('Tu vinculación fue realizada')
                       ->view('email.aviso-vinculacion')
                       ->with([
                        'paciente' => $this->paciente,
                        'datosTramite' => $this->datosTramite
                    ]);;
    }

    function parsearDatosTramite(string $datos): array
    {
        $keys = [
            'tramite',
            'tipo',
            'paciente',
            'profesional',
            'fecha',
            'estado',
            'vigencia',
            'inicio',
            'fin'
        ];

        $partes = explode("\t", $datos);
        $partes = array_pad($partes, count($keys), null);

        return array_combine($keys, $partes);
    }

}
