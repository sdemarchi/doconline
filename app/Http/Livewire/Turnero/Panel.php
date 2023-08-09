<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\TurnoPaciente;
use App\Models\Paciente;
use App\Models\Turno;

class Panel extends Component
{
    public $pacienteId, $paciente, $telefono_conf, $email_conf, $hayTurnos = false, $formularioIncompleto = true;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    protected $rules = [
        'paciente.dni' => 'required|max:10',
        'paciente.fecha_nac' => 'required',
        'paciente.nombre' => 'required|max:150',
        'paciente.telefono' => 'required|numeric|digits_between:9,12',
        //'paciente.direccion' => 'required|max:150',
        'paciente.email' => 'required|email|max:150',
        'telefono_conf' => 'required|numeric|digits_between:9,12',
        //'email_conf' => 'required|email|max:150',
    ];

    public function mount(){
        $this->pacienteId = session('pacienteId');
        $this->paciente = TurnoPaciente::find($this->pacienteId);
        $this->email_conf = $this->paciente->email;
        $this->telefono_conf = $this->paciente->telefono;
    }
    
    public function render(){
        $pacienteR = Paciente::where('dni',$this->paciente->dni)->first();
        $this->hayTurnos = Turno::where('paciente_id',$this->pacienteId)
                    ->where('fecha','>=',Carbon::now())
                    ->first();
        if($pacienteR){
            $this->formularioIncompleto = false;
        }
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
        return view('livewire.turnero.panel',compact('turnos'));
    }

    public function nuevoTurno(){
        if(!$this->paciente->nombre){
            return redirect()->route('turnero.datos');
        }
        return redirect()->route('turnero.turnos');
    }

    public function misTurnos(){
        return redirect()->route('turnero.misturnos');
    }

    public function guardarDatos() {
        $this->validate();
        $result = TurnoPaciente::where('email',$this->paciente->email)->first();
        if(!$this->paciente->es_gmail){
            if($result){
                if($this->pacienteId <> $result->id){
                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'La dirección de E-Mail ingresada ya está en uso']);
                    return;
                }
            } 
            if($this->paciente->email <> $this->email_conf){
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Los E-Mail no coinciden"]);
                return;
            }
        }
        if($this->paciente->telefono <> $this->telefono_conf){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Los Teléfonos no coinciden"]);
            return;
        } 
        
        $this->paciente->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los Datos se actualizaron con éxito"]);
    }

    public function cancelarTurno($id){
        Turno::find($id)->update([
                        'paciente_id' => null,
                        'id_cupon' => null,
                        'importe' => null,
                        'descuento' => 0,
                        'comprobante_pago' => null
                    ]);
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
