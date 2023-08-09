<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Beneficio;

class Beneficios extends Component
{
    
    public $beneficios, $beneficioAgregar;

    protected $rules = [
        'beneficioAgregar' => 'required',
        'beneficios.*.idbeneficio' => 'required',
        'beneficios.*.beneficio' => 'required|max:200',
    ];

    public function render()
    {
        $this->beneficios = Beneficio::orderBy('beneficio','ASC')->get();
        return view('livewire.beneficios');
    }

    public function guardarItem($id){
        $this->validateOnly('beneficios.*.beneficio');
        
        $this->beneficios[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        $item = Beneficio::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
    }

    public function agregarItem(){
        $this->validateOnly('beneficioAgregar');
        Beneficio::create([
            'beneficio' => $this->beneficioAgregar
        ]);
        $this->beneficioAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Beneficio se agregó con éxito"]);
    }
}
