<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idbeneficio';

    protected $fillable = ['beneficio'];
}