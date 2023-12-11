<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ControlHorario extends Model
{
    public $timestamps = false;
    protected $table = 'control_horario';

    protected $fillable = ['user_id','inicio','fin','liquidado','comentarios','feriado'];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getHorasTrabajadas(){
        $inicio = Carbon::createFromFormat('Y-m-d H:i:s',$this->inicio);
        $fin = Carbon::createFromFormat('Y-m-d H:i:s',$this->fin);
        $total = $inicio->diffInMinutes($fin);
        $horas = str_pad(intval($total/60), 2, 0, STR_PAD_LEFT);
        $minutos = str_pad($total - $horas * 60, 2, 0, STR_PAD_LEFT);
        return $horas . ':' . $minutos;
    }

}
