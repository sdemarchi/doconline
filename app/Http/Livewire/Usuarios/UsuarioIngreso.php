<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\ControlHorario;

class UsuarioIngreso extends Component
{
    public $fecha, $hora, $comentarios, $feriado = 0;

    protected $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'comentarios' => 'max:250'
    ];


    public function mount(){
        $this->fecha = date('Y-m-d');
        $this->hora = date('H:i');
    }

    public function render()
    {
        return view('livewire.usuarios.usuario-ingreso');
    }

    public function registrar(){
        if($this->_buscarIngreso()){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Ya existe un ingreso registrado. Debe anularlo para volver a registrarlo"]);
            return;
        }
        $this->validate();
        //dd($this->fecha . ' ' . $this->hora);
        ControlHorario::create([
            'user_id' => Auth::user()->id,
            'inicio' => $this->fecha . ' ' . $this->hora,
            'feriado' => $this->feriado,
            'comentarios' => $this->comentarios
        ]);
        return redirect()->route('usuarios.mi-registro')->with('ok',"Se registró el Ingreso a las $this->hora");
    }

    private function _buscarIngreso(){
        $ingreso = ControlHorario::where('user_id',Auth::user()->id)
                                    ->where('fin', null)->first();
        if($ingreso){
            return true;
        } else {
            return false;
        }
    }
}
