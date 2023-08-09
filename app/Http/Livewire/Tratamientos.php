<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Tratamiento;
use App\Models\Paciente;


class Tratamientos extends Component
{
    public $tratamientos, $tratAgregar;

    protected $rules = [
        'tratAgregar' => 'required',
        'tratamientos.*.idtrata' => 'required',
        'tratamientos.*.tratamiento' => 'required|max:200',
    ];

    public function render()
    {
        $this->tratamientos = Tratamiento::orderBy('tratamiento','ASC')->get();
        return view('livewire.tratamientos');
    }

    public function guardarItem($id){
        $this->validateOnly('tratamientos.*.tratamiento');
        
        $this->tratamientos[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        if($this->_checkIntegrity($id)){
            $item = Tratamiento::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Item no se puede eliminar por tener referencias"]);
        }
    }

    public function agregarItem(){
        $this->validateOnly('tratAgregar');
        Tratamiento::create([
            'tratamiento' => $this->tratAgregar
        ]);
        $this->tratAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Tratamiento se agregó con éxito"]);
    }

    private function _checkIntegrity($id){
        return true;
        //$paciente = Paciente::where('producto','like','%'.$id.'%')->first();
        //return $paciente ? false : true;
    }
}
