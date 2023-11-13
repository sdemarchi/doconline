<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\TurnoPaciente;

class FichaPaciente extends Component
{
    public $pacienteId, $paciente;

    protected $rules = [
        'paciente.nombre' => '',
        'paciente.dni' => '',
        'paciente.fecha_nac' => '',
        'paciente.nombre' => '',
        'paciente.telefono' => '',
        'paciente.direccion' => '',
        'paciente.email' => '',
    ];
    public function render()
    {
        $this->paciente = TurnoPaciente::find($this->pacienteId);
        return view('livewire.turnero.backend.ficha-paciente');
    }
}
