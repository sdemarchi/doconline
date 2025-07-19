<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'iddiagnostico';

    protected $fillable = ['diagnostico'];
}
