<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Producto;
use App\Models\Paciente;

class Productos extends Component
{
    public $productos, $productoAgregar;

    protected $rules = [
        'productoAgregar' => 'required',
        'productos.*.idproducto' => 'required',
        'productos.*.producto' => 'required|max:40',
    ];

    public function render()
    {
        $this->productos = Producto::orderBy('producto','ASC')->get();
        return view('livewire.productos');
    }

    public function guardarItem($id){
        $this->validateOnly('productos.*.producto');
        
        $this->productos[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarItem($id){
        if($this->_checkIntegrity($id)){
            $item = Producto::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Item no se puede eliminar por tener referencias"]);
        }
    }

    public function agregarItem(){
        $this->validateOnly('productoAgregar');
        Producto::create([
            'producto' => $this->productoAgregar
        ]);
        $this->productoAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Producto se agregó con éxito"]);
    }

    private function _checkIntegrity($id){
        $paciente = Paciente::where('producto','like','%'.$id.'%')->first();
        return $paciente ? false : true;
    }
}
