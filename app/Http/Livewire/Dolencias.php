<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Dolencia;
use App\Models\Paciente;

class Dolencias extends Component
{
    public $dolencias, $dolenciaAgregar, $descripAgregar;

    protected $rules = [
        'dolenciaAgregar' => 'required',
        'descripAgregar' => 'required',
        'dolencias.*.iddolencia' => 'required',
        'dolencias.*.dolencia' => 'required|max:100',
        'dolencias.*.decrip_profesional' => 'required|max:100',

    ];

    public function render()
    {
        $this->dolencias = Dolencia::orderBy('dolencia','ASC')->get();
        return view('livewire.dolencias');
    }

    public function guardarItem($id){
        $this->validateOnly('dolencias.*.dolencia');
        $this->validateOnly('dolencias.*.decrip_profesional');

        $this->dolencias[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        if($this->_checkIntegrity($id)){
            $item = Dolencia::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Item no se puede eliminar por tener referencias"]);
        }
    }

    public function agregarItem(){
        $this->validateOnly('dolenciaAgregar');
        $this->validateOnly('descripAgregar');
        Dolencia::create([
            'dolencia' => $this->dolenciaAgregar,
            'decrip_profesional' => $this->descripAgregar
        ]);
        $this->dolenciaAgregar = '';
        $this->descripAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Beneficio se agregó con éxito"]);
    }

    private function _checkIntegrity($id){
        $paciente = Paciente::where('dolores','like','%'.$id.'%')->first();
        return $paciente ? false : true;
    }
}
