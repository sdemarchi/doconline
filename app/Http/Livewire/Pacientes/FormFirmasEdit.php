<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;

use App\Models\Paciente;


class FormFirmasEdit extends Component
{
    public $pacienteId;

    public $nom_ape, $dni, $firma, $aclaracion, $celular;

    protected $rules = [
        'nom_ape' => '',
        'dni' => '',
        'celular' => ''
        ];

    public function mount(){
        $paciente = Paciente::where('idpaciente', $this->pacienteId)->first();
        $this->nom_ape = $paciente->nom_ape;
        $this->dni = $paciente->dni;
        $this->celular = $paciente->celular;
        $this->firma = $paciente->firma_v2;
        $this->aclaracion = $paciente->aclaracion_v2;
    }

    public function render()
    {
        return view('livewire.pacientes.form-firmas-edit');
    }

    public function guardarFirma($firma){
        $this->firma = $firma;
        Paciente::find($this->pacienteId)->update(['firma_v2' => $this->firma]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardó la firma"]);
    }

    public function guardarAclaracion($aclaracion){
        $this->aclaracion = $aclaracion;
        Paciente::find($this->pacienteId)->update(['aclaracion_v2' => $this->aclaracion]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardó la aclaracion"]);
    }
}
