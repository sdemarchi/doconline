<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Turno;

class EnviarRecordatorioTurnos extends Command
{
    protected $signature = 'turnos:recordatorio';
    protected $description = 'Envía recordatorios de turnos del día';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $hoy = now()->toDateString();
        $turnos = Turno::whereDate('fecha', $hoy)->get();

        $this->info("Cantidad de turnos encontrados: " . $turnos->count());

        foreach ($turnos as $turno) {
            $paciente = $turno->paciente;
            $prestador = $turno->prestador;

            // Si faltan relaciones, salteamos el envío
            if (!$paciente || !$prestador || !$paciente->email) {
                $this->info("Faltan datos para el turno con ID {$turno->id}. No se enviará recordatorio.");
                continue;
            }

            $nombrePaciente = $paciente->nombre;
            $email = $paciente->email;
            $fecha = \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y');
            $hora = $turno->hora;
            $lugar = $turno->lugar ?? 'Virtual';
            $medico = $prestador->nombre;

            $mensaje = <<<EOT
Hola {$nombrePaciente}.
Te recordamos que hoy tenés programado el turno con Doc Online.
Unite a la llamada desde este enlace del consultorio virtual 01 https://meet.google.com/myp-gkzo-iuh

Fecha: {$fecha}
Hora: {$hora}
Lugar: {$lugar}
Profesional: {$medico}

Por favor, asegúrese de estar disponible y conectado a tiempo.
Cualquier duda, podés contactarnos.
¡Gracias por confiar en nosotros!
EOT;

            Mail::raw($mensaje, function ($message) use ($email) {
                $message->to($email)
                        ->subject('Recordatorio de turno')
                        ->setCharset('UTF-8')
                        ->setContentType('text/plain; charset=UTF-8');
            });
        }


        // Agrupar los turnos por prestador y enviar resumen diario
        $turnosPorPrestador = $turnos->groupBy('prestador_id');

        foreach ($turnosPorPrestador as $prestadorId => $turnosDelPrestador) {
            $prestador = $turnosDelPrestador->first()->prestador;

            if (!$prestador || !$prestador->email) {
                $this->info("Prestador con ID {$prestadorId} sin email. Se omite envío.");
                continue;
            }

            $emailPrestador = $prestador->email;
            $nombrePrestador = $prestador->nombre;

            $mensajePacientes = "Hola {$nombrePrestador}. Tenés turnos asignados para hoy:\n\n";

            foreach ($turnosDelPrestador as $turno) {
                $paciente = $turno->paciente;
                if (!$paciente) continue;

                $nombrePaciente = $paciente->nombre;
                $fecha = \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y');
                $hora = $turno->hora;
                $lugar = $turno->lugar ?? 'Virtual';

                $mensajePacientes .= " • {$nombrePaciente} a las {$hora} -  {$lugar}\n\nUnite desde el enlace https://meet.google.com/myp-gkzo-iuh";
            }

            $this->info("Enviar resumen al prestador " . $emailPrestador);
            Mail::raw($mensajePacientes, function ($message) use ($emailPrestador) {
                $message->to("agugodzic@gmail.com")
                        ->subject('Turnos asignados para hoy')
                        ->setCharset('UTF-8')
                        ->setContentType('text/plain; charset=UTF-8');
            });
        }

    }
}
