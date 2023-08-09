<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;

use App\Models\TurnoPaciente;

class Login extends Component
{
    public $dni, $fecha_nac;

    protected $rules = [
        'dni' => 'required|max:10',
        'fecha_nac' => 'required'
    ];

    
    public function mount(){
        if(session('pacienteId')){
            $this->dni = session('pacienteDni');
            $this->fecha_nac = session('pacienteFechaNac');
        }
    }
    
    public function render()
    {
        return view('livewire.turnero.login');
    }

    
    public function ingresar(){
        $this->validate();
        $paciente = TurnoPaciente::where('dni', $this->dni)->first();
        if($paciente){
            if($paciente->fecha_nac == $this->fecha_nac){
                session(['pacienteId' => $paciente->id]);
                session(['pacienteDni' => $paciente->dni]);
                session(['pacienteFechaNac' => $paciente->fecha_nac]);
                if($paciente->nombre) { //Ya ingresó sus datos
                    return redirect()->route('turnero.panel');
                } else {
                    return redirect()->route('turnero.datos');
                }
            } else {
                if($paciente->nombre){//significa que ya completó el registro y no puede alterar su fecha de nacimiento
                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Los datos de acceso no son correctos"]);
                    
                } else { //nunca completó el registro, así que puede ingresar con otra fecha de nacimiento
                    $paciente->fecha_nac = $this->fecha_nac;
                    $paciente->save();
                    session(['pacienteId' => $paciente->id]);
                    session(['pacienteDni' => $paciente->dni]);
                    session(['pacienteFechaNac' => $paciente->fecha_nac]);
                    return redirect()->route('turnero.datos');
                }
            }
        } else { //Ingresa por primera vez
            $id = TurnoPaciente::Create([
                'dni' => $this->dni,
                'fecha_nac' => $this->fecha_nac
            ])->id;
            session(['pacienteId' => $id]);
            session(['pacienteDni' => $this->dni]);
            session(['pacienteFechaNac' => $this->fecha_nac]);
            return redirect()->route('turnero.datos');
        }
    }
}
