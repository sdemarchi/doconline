<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoGrow extends Model
{
    // Nombre de la tabla
    protected $table = 'tipo_grow';

    // Clave primaria
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Columnas asignables masivamente
    protected $fillable = ['descripcion'];

    // Relación con Grow: un tipo puede tener muchos grow
    public function grows(){
        return $this->hasMany(Grow::class, 'tipo_id', 'id');
    }
}
