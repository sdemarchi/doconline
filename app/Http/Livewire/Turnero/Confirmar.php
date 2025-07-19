<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Turno;
use App\Models\TurnoPaciente;
use App\Models\Paciente;

class Confirmar extends Component
{
    public $pacienteId, $turno, $paciente, $detalle, $formularioIncompleto = true;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    protected $rules = [
        'paciente.dni' => '',
        'paciente.nombre' => '',
        'paciente.email' => '',
    ];

    public function mount(){
        $this->pacienteId = session('pacienteId');
    }

    public function render()
    {
        $this->paciente = TurnoPaciente::find($this->pacienteId);
        $this->turno = Turno::find($this->paciente->temp_turno);
        if(! $this->turno){
            $this->redirect(route('turnero'));
        }
        
        $date = date_create($this->turno->fecha . ' ' . $this->turno->hora);
        $fechaFormat = $this->_formatearFecha($this->turno->fecha);
        $this->detalle = date_format($date,"H:i") . ' - ' . $fechaFormat .  ' - ' . $this->turno->prestador->nombre;
        return view('livewire.turnero.confirmar');
    }

    public function avanzar() {
        //Resetea toda la info del turno por si quedó abandonado por otro paciente
        Turno::find($this->turno->id)->update([
            'paciente_id' => null,
            'fecha_emision' => null,
            'id_cupon' => null,
            'importe' => null,
            'descuento' => 0,
        ]);
        return redirect()->route('turnero.pagos');
        
    }

    /*private function _pagado(){
        $pacienteR = Paciente::where('dni',$this->paciente->dni)->first();
        if(!$pacienteR) return false;
        if($pacienteR->pagado){
            return true;
        } else {
            return false;
        }
    }*/

    private function _formatearFecha($fecha){
        $fechaPhp = date_create($fecha);
        $mes = $this->meses[intval(date_format($fechaPhp,"m"))-1];
        $dia = date_format($fechaPhp,"j");
        $diaTxt = $this->dias[intval(date_format($fechaPhp,"w"))];
        $anio = date_format($fechaPhp,"Y");
        return "$diaTxt $dia de $mes de $anio";
    }
}
