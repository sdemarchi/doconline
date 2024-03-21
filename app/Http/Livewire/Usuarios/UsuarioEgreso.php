<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\ControlHorario;

class UsuarioEgreso extends Component
{
    public $fecha, $hora, $comentarios;
    protected $listeners = ['actualizarFechaYHora'];


    public function actualizarFechaYHora($fecha, $hora)
    {
        $this->fecha = $fecha;
        $this->hora = $hora;
    }


    protected $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'comentarios' => 'max:250'
    ];


    public function mount(){
        $this->fecha = date('Y-m-d');
        $this->hora = date('H:i');
        //dd($this->hora);
    }

    public function render()
    {
        $ingreso = $this->_buscarIngreso();
        if($ingreso){
            $this->comentarios = $ingreso->comentarios;
        }
        return view('livewire.usuarios.usuario-egreso');
    }

    public function registrar(){
        $ingreso = $this->_buscarIngreso();
        if(!$ingreso){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "No se puede registrar un egreso ya que no existe ningún ingreso registrado"]);
            return;
        }
        $this->validate();
        $ingreso->fin = $this->fecha . ' ' . $this->hora;
        $ingreso->comentarios = $this->comentarios;
        $ingreso->save();

        return redirect()->route('usuarios.mi-registro')->with('ok',"Se registró el Egreso a las $this->hora");

    }

    private function _buscarIngreso(){
        $ingreso = ControlHorario::where('user_id',Auth::user()->id)
                                    ->where('fin', null)->first();
        return $ingreso;
    }
}
