<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoMedico extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idmedico';
    
    protected $table = "datos_medico";
    
    protected $fillable = ['apeynom','tipo_nro_doc','matricula','especialidad','domicilio','tel_part','tel_cel','email','firma','sello'];
}
