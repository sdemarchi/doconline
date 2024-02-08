<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grow;
use App\Models\TurnoPaciente;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'id_paciente',
        'id_pagador',
        'id_grow',
        'email_paciente',
        'email_pagador',
        'monto',
        'descuento',
        'monto_final',
        'codigo',
        'utilizado',
        'verificado',
        'comprobante',
        'nombre_paciente',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at'];

    public function grow(){
        return $this->hasOne(Grow::class,'idgrow', 'id_grow');
    }

    public function pagador(){
        return $this->hasOne(TurnoPaciente::class,'id', 'id_pagador');
    }
}
