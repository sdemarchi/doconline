<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Turno;

class EnviarRecordatorioTurnos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature ='turnos:recordatorio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
public function handle()
{
    $hoy = now()->toDateString();

    $turnos = Turno::whereDate('fecha', $hoy)->get(); // o el campo correspondiente

    foreach ($turnos as $turno) {
       // $paciente = $turno->paciente; // Asegurate de tener relación definida
        //$email = $paciente->email;
         $email = 'agugodzic@gmail.com';

       // if (!$email) continue;

     /*   Mail::raw("Hola {$paciente->nombre}, te recordamos que tenés un turno hoy a las {$turno->hora}.", function ($message) use ($email) {
            $message->to($email)->subject('Recordatorio de turno');
        });*/


           Mail::raw("Hola , te recordamos que tenés un turno hoy a las ejemplo.", function ($message) use ($email) {
            $message->to($email)->subject('Recordatorio de turno');
        });
    }

    $this->info("Mails enviados correctamente.");
}

}
