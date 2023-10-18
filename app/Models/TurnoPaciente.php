<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Turno;

class TurnoPaciente extends Model
{
    public $timestamps = false;
    protected $table = "turn_pacientes";

    protected $fillable = ['dni','fecha_nac','nombre','telefono','direccion','email','es_gmail','temp_turno',
                            'username','password'];

    public function ultimo_turno(){
        $turno = Turno::where('paciente_id',$this->id)
            ->orderBy('fecha','DESC')
            ->first();
        return $turno;
    }

    public function turno(){
        return $this->hasMany(Turno::class, 'id', 'paciente_id');
    }

}
