<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dolencia;
use App\Models\TurnoPaciente;
use App\Models\PacienteONG;

class Grow extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idgrow';


    protected $fillable = ['nombre','cbu','alias','titular','mail','instagram','celular','idprovincia',
                            'localidad','direccion','cp','cod_desc','fe_ingreso','observ','activo','descuento',
                            'imagen1','imagen2','url','tipo_id'];


    public function provincia(){
        return $this->belongsTo(Provincia::class, 'idprovincia');
    }


    public function pacientes(){
        return $this->hasMany(TurnoPaciente::class, 'grow');
    }

    public function tipo(){
        return $this->belongsTo(TipoGrow::class, 'tipo_id', 'id');
    }

    // Un Grow del tipo ONG tiene muchos pacientes
    public function pacientesONG(){
        return $this->hasMany(PacienteONG::class, 'idgrow', 'idgrow');
    }
}
