<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Turno;

class MisTurnos extends Component
{
    Public $pacienteId;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    public function mount(){
        $this->pacienteId = session('pacienteId');
    }
    
    public function render()
    {
        $misTurnos = Turno::where('paciente_id',$this->pacienteId)
                    ->where('fecha','>=',Carbon::now())
                    ->get();
        $turnos = [];
        foreach($misTurnos as $turno){
            $fecha = $this->_formatearFecha($turno->fecha);
            
            $turnos[] = [
                'id' => $turno->id,
                'prestador' => $turno->prestador->nombre,
                'fecha' => $fecha,
                'hora' => $turno->hora,
            ];
        }

        return view('livewire.turnero.mis-turnos', compact('turnos'));
    }

    public function cancelarTurno($id){
        Turno::find($id)->update(['paciente_id' => null]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Su turno se canceló"]);
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
