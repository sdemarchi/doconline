<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\Turno;
use App\Models\Prestador;


class TurnoEdit extends Component
{
    public $turnoId, $prestadorId, $fecha, $hora, $prestadores;

    protected $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'prestadorId' => 'required'
    ];
    
    public function mount(){
        $this->prestadores = Prestador::get();
        if($this->turnoId){
            $turno = Turno::find($this->turnoId);
            $this->fecha = $turno->fecha;
            $this->hora = $turno->hora; 
            $this->prestadorId = $turno->prestador_id;
        }
    }
    
    public function render()
    {
        return view('livewire.turnero.backend.turno-edit');
    }

    public function update(){
        $this->validate();
        $dataTurno = [
            'fecha' => $this->fecha,
            'hora' => $this->hora,
            'prestador_id' => $this->prestadorId
        ];
        if($this->turnoId){
            Turno::find($this->turnoId)->update($dataTurno);
        } else {
            $this->turnoId = Turno::create($dataTurno)->id;
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se guardó con éxito"]);
    }
}
