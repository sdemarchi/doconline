<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CBU extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'cbus';
    protected $fillable = ['alias', 'cbu'];
}
