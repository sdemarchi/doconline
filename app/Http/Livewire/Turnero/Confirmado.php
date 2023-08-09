<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Turno;
use App\Models\TurnoPaciente;
use App\Models\Paciente;

class Confirmado extends Component
{
    public $pacienteId, $turnoId, $turno, $detalle, $formularioIncompleto = true;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    
    public function mount(){
        $this->pacienteId = session('pacienteId');
    }
    
    public function render()
    {
        $paciente = TurnoPaciente::find($this->pacienteId);
        $this->turno = Turno::find($paciente->temp_turno);
        if(! $this->turno){
            $this->redirect(route('turnero'));
        }

        $pacienteR = Paciente::where('dni',$paciente->dni)->first();
        if($pacienteR){
            $this->formularioIncompleto = false;
        }

        $date = date_create($this->turno->fecha . ' ' . $this->turno->hora);
        $fechaFormat = $this->_formatearFecha($this->turno->fecha);
        $this->detalle = date_format($date,"H:i") . ' - ' . $fechaFormat .  ' - ' . $this->turno->prestador->nombre;
        
        return view('livewire.turnero.confirmado');
    }

    private function _formatearFecha($fecha){
        $fechaPhp = date_create($fecha);
        $mes = $this->meses[intval(date_format($fechaPhp,"m"))-1];
        $dia = date_format($fechaPhp,"j");
        $diaTxt = $this->dias[intval(date_format($fechaPhp,"w"))];
        $anio = date_format($fechaPhp,"Y");
        return "$diaTxt $dia de $mes de $anio";
    }
}
