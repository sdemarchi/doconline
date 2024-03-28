<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dolencia;
use App\Models\TurnoPaciente;

class Grow extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idgrow';


    protected $fillable = ['nombre','cbu','alias','titular','mail','instagram','celular','idprovincia',
                            'localidad','direccion','cp','cod_desc','fe_ingreso','observ','activo','descuento',
                            'imagen1','imagen2','url'];


    public function provincia(){
        return $this->belongsTo(Provincia::class, 'idprovincia');
    }


    public function pacientes(){
        return $this->hasMany(TurnoPaciente::class, 'grow');
    }
}
