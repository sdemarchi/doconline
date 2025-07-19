<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoConf extends Model
{
    private $dias = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo'];

    public $timestamps = false;
    protected $table = 'turnos_conf';

    protected $fillable = ['prestador_id','dia_semana','hora_desde_1','hora_hasta_1','hora_desde_2','hora_hasta_2',
                            'hora_desde_3','hora_hasta_3','duracion_turno'];

    public function dia(){
        return $this->dias[$this->dia_semana - 1];
    }

}
