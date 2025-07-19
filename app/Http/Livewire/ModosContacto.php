<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ModoContacto;
use App\Models\Paciente;

class ModosContacto extends Component
{
    public $contactos, $contactoAgregar;

    protected $rules = [
        'contactoAgregar' => 'required',
        'contactos.*.idcontacto' => 'required',
        'contactos.*.modo_contacto' => 'required|max:200',
    ];
    
    public function render()
    {
        $this->contactos = ModoContacto::orderBy('modo_contacto','ASC')->get();
        return view('livewire.modos-contacto');
    }

    public function guardarItem($id){
        $this->validateOnly('contactos.*.modo_contacto');
        
        $this->contactos[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        if($this->_checkIntegrity($id)){
            $item = ModoContacto::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        } else {
            //session()->flash('error', "El Item no se puede eliminar por tener referencias");
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Item no se puede eliminar por tener referencias"]);
        }
    }

    public function agregarItem(){
        $this->validateOnly('contactoAgregar');
        ModoContacto::create([
            'modo_contacto' => $this->contactoAgregar
        ]);
        $this->contactoAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Modo de Contacto se agregó con éxito"]);
    }

    private function _checkIntegrity($id){
        $paciente = Paciente::where('idcontacto',$id)->first();
        return $paciente ? false : true;
    }
}
