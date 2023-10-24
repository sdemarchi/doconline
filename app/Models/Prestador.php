<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    protected $fillable = ["dias_anticipacion"];
    public $timestamps = false;
    protected $table = "turn_prestadores";

}
