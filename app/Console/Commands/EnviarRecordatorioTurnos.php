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

           $mensaje = "
            <!DOCTYPE html>
            <html>
            <body style='margin:0; padding:20px; font-family:Arial, sans-serif; background-color:#f4f6f8;'>

            <table width='100%' cellpadding='0' cellspacing='0'>
            <tr>
            <td align='center'>

            <table width='600' cellpadding='0' cellspacing='0'
                style='background:#ffffff; padding:30px; border-radius:8px;'>

            <tr><td>

            <h2 style='margin-top:0; color:#2c3e50;'>Hola {$nombrePaciente}</h2>

            <p>Te recordamos que hoy tenés programado tu turno con <strong>Doc Online</strong>.</p>

            <p>
            <strong>Fecha:</strong> {$fecha}<br>
            <strong>Hora:</strong> {$hora}<br>
            <strong>Lugar:</strong> {$lugar}<br>
            <strong>Profesional:</strong> {$medico}
            </p>

            <p>En la fecha y hora indicados, podés ingresar al turno desde el siguiente botón:</p>

            <p style='text-align:center; margin:30px 0;'>
            <a href='https://meet.google.com/rgh-rqaw-kyf'
            style='display:inline-block;
                    background-color:#27ae60;
                    padding:12px 25px;
                    border-radius:30px;
                    color:#ffffff;
                    text-decoration:none;
                    font-weight:bold;'>
            Ingresar al turno
            </a>
            </p>

            <hr style='border:none; border-top:1px solid #e0e0e0; margin:30px 0;'>

            <p style='text-align:center; font-size:12px; color:#777;'>
            Seguinos en nuestras redes
            </p>

            <p style='text-align:center;'>
            <a href='https://instagram.com/doconlineargentina'
            style='display:inline-block;
                    background-color:#dce9ef;
                    padding:8px 18px;
                    border-radius:25px;
                    text-decoration:none;
                    font-size:14px;
                    color:#000;'>
            <img src='https://cdn-icons-png.flaticon.com/512/2111/2111463.png'
                    width='16'
                    style='vertical-align:middle; margin-right:6px;'>
            <span style='vertical-align:middle;'>DocOnline</span>
            </a>
            </p>

            </td>
            </tr>
            </table>

            </td>
            </tr>
            </table>

            </body>
            </html>
            ";

            Mail::html($mensaje, function ($message) use ($email) {
                $message->to($email)
                        ->subject('Recordatorio de turno');
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

            $emailPrestador =  $prestador->email;
            $nombrePrestador = $prestador->nombre;

            $mensajePacientes = "Hola {$nombrePrestador}. Tenés turnos asignados para hoy:\n\n";

            foreach ($turnosDelPrestador as $turno) {
                $paciente = $turno->paciente;
                if (!$paciente) continue;

                $nombrePaciente = $paciente->nombre;
                $fecha = \Carbon\Carbon::parse($turno->fecha)->format('d/m/Y');
                $hora = $turno->hora;
                $lugar = $turno->lugar ?? 'Virtual';

                $mensajePacientes .= " • {$nombrePaciente} a las {$hora} -  {$lugar}\n";
            }

            $mensajePacientes .= "\nUnite desde el enlace https://meet.google.com/rgh-rqaw-kyf";

            $this->info("Enviar resumen al prestador " . $emailPrestador);
            Mail::raw($mensajePacientes, function ($message) use ($emailPrestador) {
                $message->to($emailPrestador)
                        ->subject('Turnos asignados para hoy')
                        ->setCharset('UTF-8')
                        ->setContentType('text/plain; charset=UTF-8');
            });
        }

    }
}
