<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacientePatologia extends Model
{
    public $timestamps = false;
    protected $table = "patologias";
    protected $primaryKey = 'idpato';

    protected $fillable = ['item','dni','idpaciente','anio_aprox','medicacion','prob_trabajo','dolor_intensidad',
    'partes_cuerpo','atenua_dolor'];

    public function patologia(){
        return $this->belongsTo(Dolencia::class, 'item');
    }
}
