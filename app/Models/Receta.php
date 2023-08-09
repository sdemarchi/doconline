<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['nombre','dni','obra_social','fecha','detalle','diagnostico'];

}
