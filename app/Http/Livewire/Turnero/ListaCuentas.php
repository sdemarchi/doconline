<?php
namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use App\Models\CBU;

class ListaCuentas extends Component
{
    public function render()
    {
        $this->cuentas = CBU::get();
        return view('livewire.turnero.lista-cuentas');
    }

        public $cuentas, $cbuAgregar, $aliasAgregar;

        protected $rules = [
            'cbuAgregar' => 'required',
            'aliasAgregar' => 'required',
            'cuentas.*.cbu' => 'required|max:100',
            'cuentas.*.alias' => 'required'
        ];

        public function guardarItem($id){
            $this->validateOnly('cuentas.*.cbu');
            $this->validateOnly('cuentas.*.alias');

            $this->cuentas[$id]->save();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
        }

        public function eliminarItem($id){
            $item = CBU::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
        }

        public function agregarItem(){
            $this->validateOnly('cbuAgregar');
            $this->validateOnly('nombreAgregar');
            CBU::create([
                'alias' => $this->aliasAgregar,
                'cbu' => $this->cbuAgregar
            ]);
            $this->cbuAgregar = '';
            $this->aliasAgregar = '';
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Beneficio se agregó con éxito"]);
        }
}
