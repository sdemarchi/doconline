<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RePassToken extends Model
{
    use HasFactory;

    protected $table = 'repass_token';

    protected $fillable = [
        'email',
        'token',
    ];
}
