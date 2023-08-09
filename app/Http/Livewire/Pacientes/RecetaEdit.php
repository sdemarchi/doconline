<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;
use Carbon\Carbon;

use App\Models\Receta;
use App\Models\Paciente;

class RecetaEdit extends Component
{
    public $recetaId, $pacienteId, $pacienteNombre, $nombre, $dni, $obraSocial, $fecha, $detalle, $diagnostico;
    
    protected $rules = [
        'nombre' => '',
        'dni' => '',
        'obraSocial' => 'required|max:255',
        'fecha' => 'required',
        'detalle' => 'required|max:1500',
        'diagnostico' => 'max:255'
    ];

    public function mount(){
        if($this->recetaId){
            $receta = Receta::find($this->recetaId);
            $this->nombre = $receta->nombre;
            $this->dni = $receta->dni;
            $this->obraSocial = $receta->obra_social;
            $this->fecha = $receta->fecha;
            $this->detalle = $receta->detalle;
            $this->diagnostico = $receta->diagnostico;
        } else {
            $this->fecha = date('Y-m-d');
        }
    }

    
    public function render()
    {
        return view('livewire.pacientes.receta-edit');
    }

    public function update(){
        $this->validate();
        if($this->recetaId){
            Receta::find($this->recetaId)->update([
                'nombre' => $this->nombre,
                'dni' => $this->dni,
                'obra_social' => $this->obraSocial,
                'fecha' => $this->fecha,
                'detalle' => $this->detalle,
                'diagnostico' => $this->diagnostico,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "La receta se actualizó con éxito"]);
        } else {
            Receta::create([
                'nombre' => $this->nombre,
                'dni' => $this->dni,
                'obra_social' => $this->obraSocial,
                'fecha' => $this->fecha,
                'detalle' => $this->detalle,
                'diagnostico' => $this->diagnostico,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "La receta se creó con éxito"]);
        }
    }

    public function buscarPaciente($id){
        $paciente = Paciente::find($id);
        $this->nombre = $paciente->nom_ape;
        $this->dni = $paciente->dni;
        $this->obraSocial = $paciente->osocial;
        $this->pacienteId = $id;
    }

}
