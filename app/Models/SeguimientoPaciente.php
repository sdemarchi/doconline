<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguimientoPaciente extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'seguimiento_pacientes';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paciente_id', // Clave foránea al paciente
        'ong_id',
        'proc_propuesto',
        'dosis_text',
        'concentracion',
        'ratio',
        'disolucion',
        'tipo_frec_analitica',
        'dosificaciones',
        'beneficios_razonables',
        'evolucion',
        'observaciones'
    ];

    /**
     * Define la relación con la ONG.
     */
    public function ong()
    {
        return $this->belongsTo(Grow::class, 'ong_id','idgrow');
    }

    /**
     * Define la relación con el Paciente.
     */
    public function paciente()
    {
        // belongsTo(Modelo, ClaveForaneaLocal)
        return $this->belongsTo(Paciente::class, 'paciente_id', 'idpaciente');
    }
}
