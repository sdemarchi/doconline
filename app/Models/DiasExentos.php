<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasExentos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dias_exentos';
    protected $fillable = ['fecha', 'motivo'];
}
