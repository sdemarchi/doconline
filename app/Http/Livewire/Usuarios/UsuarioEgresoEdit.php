<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use App\Models\ControlHorario;

class UsuarioEgresoEdit extends Component
{
    public $registroId, $usuario, $fecha, $hora, $comentarios;
   
    protected $rules = [
        'fecha' => 'required',
        'hora' => 'required',
        'comentarios' => 'max:250'
    ];
    
    public function mount(){
        $registro = ControlHorario::find($this->registroId);
        $this->usuario = $registro->usuario->name;
        $this->fecha = date_format(date_create($registro->fin),'Y-m-d');
        $this->hora = date_format(date_create($registro->fin),'H:i');
        $this->comentarios = $registro->comentarios;
    }
    
    public function render()
    {
        return view('livewire.usuarios.usuario-egreso-edit');
    }

    public function update(){
        $this->validate();
        ControlHorario::find($this->registroId)->update([
            'fin' => $this->fecha . ' ' . $this->hora,
            'comentarios' => $this->comentarios
        ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se modificó el Egreso"]);
            
    }
}
