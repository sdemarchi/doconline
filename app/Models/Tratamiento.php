<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idtrata';

    protected $fillable = ['tratamiento'];
}
