<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;

use App\Models\User;

class Usuarios extends Component
{

    public function render()
    {
        $usuarios = User::orderBy('username','ASC')->get();
        return view('livewire.usuarios.usuarios', compact('usuarios'));
    }

    public function eliminar($id){
        User::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el usuario"]);
    }

    public function editar($usuarioId){
        return redirect()->route('usuarios.edit', $usuarioId);
    }
}
