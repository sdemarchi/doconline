<?php

namespace App\Http\Livewire\Cupones;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cupon;
use App\Models\Turno;

class Cupones extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $cuponAgregar, $descripcionAgregar, $descuentoAgregar;

    public function render()
    {
        $cupones = Cupon::orderBy('id','DESC')->paginate(20);
        return view('livewire.cupones.cupones',compact('cupones'));
    }

    public function agregarCupon(){
        $this->validate([
            'cuponAgregar' => 'required|max:150',
            'descripcionAgregar' => '|max:250',
            'descuentoAgregar' => 'required|numeric|min:1|max:999999'
        ]);
        //verifica que no exista ya
        $cupon = Cupon::where('codigo',$this->cuponAgregar)->first();
        if($cupon){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El Cupón que intenta agregar ya existe"]);
            return;
        }
        Cupon::create([
            'codigo' => $this->cuponAgregar,
            'descripcion' => $this->descripcionAgregar,
            'descuento' => $this->descuentoAgregar,
            'activo' => 1
        ]);
        $this->cuponAgregar = '';
        $this->descripcionAgregar = '';
        $this->descuentoAgregar = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Cupón de Descuento se agregó con éxito"]);
    }

    public function switch($id,$activo){
        $action = $activo ? "activó" : "desactivó";
        Cupon::find($id)->update(['activo' => $activo]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Cupón se $action con éxito"]);
    }

    public function eliminar($id){
        $turnos = Turno::where('id_cupon',$id)->first();
        if($turnos){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El cupón ya fue aplicado. No se puede eliminar"]);
            return;
        } 
        Cupon::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Cupón se eliminó con éxito"]);
    }
}
