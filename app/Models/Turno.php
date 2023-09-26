<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Prestador;
use App\Models\TurnoPaciente;

class Turno extends Model
{
    public $timestamps = false;

    protected $fillable = ['prestador_id','fecha','hora','fecha_emision','paciente_id','comprobante_pago',
                            'cupon','importe','descuento','atendido','comentarios','pedi_captura','mando_captura'];

    public function prestador(){
        return $this->belongsTo(Prestador::class, 'prestador_id');
    }

    public function paciente(){
        return $this->belongsTo(TurnoPaciente::class, 'paciente_id');
    }
}
