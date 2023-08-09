<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    public $timestamps = false;
    protected $table = "cupones";
    
    protected $fillable = ['codigo','descripcion','descuento','activo'];
}
