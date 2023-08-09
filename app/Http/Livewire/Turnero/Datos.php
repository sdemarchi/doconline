<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;

use App\Models\TurnoPaciente;

class Datos extends Component
{
    public $pacienteId, $paciente, $telefono_conf, $email_conf, $email_actual;
    
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
        $this->email_actual = $this->paciente->email;
    }

    public function render()
    {
        $this->telefono = $this->paciente->telefono;
        return view('livewire.turnero.datos');
    }

    public function guardar() {
        $this->validate();
        if(!$this->paciente->es_gmail){
            $result = TurnoPaciente::where('email',$this->paciente->email)->first();
            if($result){
                if($this->email_actual != $result->email){
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
        return redirect()->route('turnero.turnos');
    }
}
