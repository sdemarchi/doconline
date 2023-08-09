<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Diagnostico;

class Diagnosticos extends Component
{
    public $diagnosticos, $diagnosticoAgregar;

    protected $rules = [
        'diagnosticoAgregar' => 'required',
        'diagnosticos.*.iddiagnostico' => 'required',
        'diagnosticos.*.diagnostico' => 'required|max:200',
    ];

    public function render()
    {
        $this->diagnosticos = Diagnostico::orderBy('diagnostico','ASC')->get();
        return view('livewire.diagnosticos');
    }

    public function guardarItem($id){
        $this->validateOnly('diagnosticos.*.diagnostico');
        
        $this->diagnosticos[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        $item = Diagnostico::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
    }

    public function agregarItem(){
        $this->validateOnly('diagnosticoAgregar');
        Diagnostico::create([
            'diagnostico' => $this->diagnosticoAgregar
        ]);
        $this->diagnosticoAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Diagnóstico se agregó con éxito"]);
    }
}
