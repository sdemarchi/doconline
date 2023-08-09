<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModoContacto extends Model
{
    public $timestamps = false;
    protected $table = "modo_contacto";
    protected $primaryKey = 'idcontacto';

    protected $fillable = ['modo_contacto'];
}
