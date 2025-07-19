<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Justificacion;

class Justificaciones extends Component
{
    public $justificaciones, $justifAgregar;

    protected $rules = [
        'justifAgregar' => 'required',
        'justificaciones.*.idjustifica' => 'required',
        'justificaciones.*.justificacion' => 'required|max:200',
    ];

    public function render()
    {
        $this->justificaciones = Justificacion::orderBy('justificacion','ASC')->get();
        return view('livewire.justificaciones');
    }

    public function guardarItem($id){
        $this->validateOnly('justificaciones.*.justificacion');
        
        $this->justificaciones[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        $item = Justificacion::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
    }

    public function agregarItem(){
        $this->validateOnly('justifAgregar');
        Justificacion::create([
            'justificacion' => $this->justifAgregar
        ]);
        $this->justifAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "La Justificación se agregó con éxito"]);
    }
}
