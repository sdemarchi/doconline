<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsuarioEdit extends Component
{
    public $usuario, $usuarioId, $name, $username, $email, $role_id, $password, $repassword;

    protected $rules = [
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => '',
        'repassword' => '',
        'role_id' => 'required',
    ];
    
    public function mount(){
        if($this->usuarioId){
            $this->usuario = User::find($this->usuarioId);
            $this->name = $this->usuario->name;
            $this->username = $this->usuario->username; 
            $this->email = $this->usuario->email;
            $this->role_id = $this->usuario->role_id;
        } else {
            $this->role_id = 1;
        }
    }
    
    public function render()
    {
        $roles = Role::get();
        return view('livewire.usuarios.usuario-edit', compact('roles'));
    }

    public function update(){
        $this->validate();
        $userNameExiste = User::where('username',$this->username)
                                ->where('id','<>',$this->usuarioId)
                                ->first();
        if ($userNameExiste){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El nombre de usuario ya existe"]);
            return;
        }
        $emailExiste = User::where('email',$this->email)
                                ->where('id','<>',$this->usuarioId)
                                ->first();
        if ($emailExiste){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El E-Mail ya existe"]);
            return;
        }
        if($this->usuarioId){ //Está actualizando
            if($this->password){
                if($this->password != $this->repassword){
                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Las contraseñas no coinciden"]);
                    return;
                }
            }
            $this->usuario->name = $this->name; 
            $this->usuario->username = $this->username;
            $this->usuario->email = $this->email;
            $this->usuario->role_id = $this->role_id;
            if($this->password){
                $this->usuario->password = Hash::make($this->password);
            }
            $this->usuario->updated_at = Carbon::now();
            $this->usuario->save();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Usuario se actualizó con éxito"]);
            
        } else { //se está creando un nuevo usuario
            if(!$this->password){
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Debe proporcionar una contraseña"]);
                return;
            } else {
                if($this->password != $this->repassword){
                    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Las contraseñas no coinciden"]);
                    return;
                }
            }
            User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role_id' => $this->role_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Usuario se creó con éxito"]);
        }

    }
}
