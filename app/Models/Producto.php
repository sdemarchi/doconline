<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idproducto';

    protected $fillable = ['producto'];

    public function cambiarDiasAnticipacion($nuevoDiasAnticipacion)
    {
        $this->update(['dias_anticipacion' => $nuevoDiasAnticipacion]);
    }
}
