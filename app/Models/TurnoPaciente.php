<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paciente;
use App\Models\Turno;

class TurnoPaciente extends Model
{
    public $timestamps = true;
    protected $table = "turn_pacientes";

    protected $fillable = ['dni','fecha_nac','nombre','telefono','direccion','email','es_gmail','temp_turno',
                            'username','password','grow'];

    public function ultimo_turno(){
        $turno = Turno::where('paciente_id',$this->id)
            ->orderBy('fecha','DESC')
            ->first();
        return $turno;
    }

    public function turno(){
        return $this->hasMany(Turno::class, 'id', 'paciente_id');
    }

    public function ficha(){
        return $this->hasOne(Paciente::class, 'dni', 'dni');
    }

    public function grow()
    {
        return $this->belongsTo(Grow::class, 'grow', 'idgrow');
    }

    public function getPacienteConGrow()
    {
        // Cargar la relación grow
        $this->load('grow');

        // Devolver el paciente con la información del grow incluida
        return $this->toArray();
    }

}
