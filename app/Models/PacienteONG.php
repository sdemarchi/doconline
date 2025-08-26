<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grow;


class PacienteONG extends Model
{
    protected $table = 'paciente_ong';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre','apellido','dni','idgrow'
    ];

    // Un paciente pertenece a un Grow
    public function grow()
    {
        return $this->belongsTo(Grow::class, 'idgrow', 'idgrow');
    }

    // Vinculación por DNI en lugar de idpaciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'dni', 'dni');
    }
}
