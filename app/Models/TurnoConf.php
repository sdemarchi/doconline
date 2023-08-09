<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoConf extends Model
{
    private $dias = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo'];
    
    public $timestamps = false;
    protected $table = 'turnos_conf';
    
    protected $fillable = ['prestador_id','dia_semana','hora_desde','hora_hasta','duracion_turno'];

    public function dia(){
        return $this->dias[$this->dia_semana - 1];
    }

}
