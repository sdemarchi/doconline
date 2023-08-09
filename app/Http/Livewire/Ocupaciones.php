<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Ocupacion;

class Ocupaciones extends Component
{
    public $ocupaciones, $ocupacionAgregar;

    protected $rules = [
        'ocupacionAgregar' => 'required',
        'ocupaciones.*.id' => 'required',
        'ocupaciones.*.ocupacion' => 'required|max:150',
    ];

    public function render()
    {
        $this->ocupaciones = Ocupacion::orderBy('ocupacion','ASC')->get();
        return view('livewire.ocupaciones');
    }

    public function guardarItem($id){
        $this->validateOnly('ocupaciones.*.ocupacion');
        
        $this->ocupaciones[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        if($this->_checkIntegrity($id)){
            $item = Ocupacion::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Item no se puede eliminar por tener referencias"]);
        }
    }

    public function agregarItem(){
        $this->validateOnly('ocupacionAgregar');
        Ocupacion::create([
            'ocupacion' => $this->ocupacionAgregar
        ]);
        $this->ocupacionAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "La ocupación se agregó con éxito"]);
    }

    private function _checkIntegrity($id){
        return false;
    }
}
