<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\Turno;
use App\Models\Prestador;
use App\Models\Paciente;
use App\Models\TurnoPaciente;


class TurnoEdit extends Component{
    public $turnoId, $prestadorId, $fecha, $hora, $prestadores, $pacienteId , $paciente, $pacienteTurneroId=0;

    protected $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'prestadorId' => 'required'
    ];

    public function mount(){
        $this->prestadores = Prestador::get();
        $this->getPaciente();

        if($this->turnoId){
            $turno = Turno::find($this->turnoId);
            $this->fecha = $turno->fecha;
            $this->hora = $turno->hora;
            $this->prestadorId = $turno->prestador_id;
        }
    }

    public function getPaciente(){
        if($this->pacienteId){

            $paciente = Paciente::find($this->pacienteId);
                $dni = $paciente->dni;
                $nombApe = $paciente->nom_ape;
                $fechaNacimiento = $paciente->fe_nacim;
                $cel = $paciente->celular;
                $email = $paciente->dni;
                $domicilio = $paciente->domicilio;
                $dataPaciente = [
                    'nombre' => $nombApe,
                    'dni' => $dni,
                    'fecha_nac' => $fechaNacimiento,
                    'telefono' => $cel,
                    'direccion' => $domicilio,
                    'email' => $email ,
                ];

                $turnoPaciente = TurnoPaciente::where('dni',$paciente->dni)->first();
                if($turnoPaciente){
                    $this->pacienteTurneroId = $turnoPaciente->id;
                }else{
                    $turnoPaciente = TurnoPaciente::create($dataPaciente);
                    $this->pacienteTurneroId = $turnoPaciente->id;
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Paciente creado"]);
                }
        }

    }

    public function render(){
        return view('livewire.turnero.backend.turno-edit');
    }

    public function update(){
        $this->validate();
        if($this->pacienteTurneroId !== 0){
            $dataTurno = [
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'prestador_id' => $this->prestadorId,
                'paciente_id' => $this->pacienteTurneroId
            ];
        }else{
            $dataTurno = [
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'prestador_id' => $this->prestadorId,
            ];
        }


        if($this->turnoId){
            Turno::find($this->turnoId)->update($dataTurno);
        } else {
            $this->turnoId = Turno::create($dataTurno)->id;
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se guardó con éxito"]);
    }
}
