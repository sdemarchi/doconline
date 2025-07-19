<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    protected $table = "justificaciones";
    public $timestamps = false;
    protected $primaryKey = 'idjustifica';

    protected $fillable = ['justificacion'];
}
