<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginToken extends Model
{
    protected $table = 'login_tokens';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'token_hash',
        'expires_at',
        'created_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(TurnoPaciente::class, 'user_id');
    }

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }

    public static function crearToken(TurnoPaciente $user): string
    {
        self::where('user_id', $user->id)->delete();

        $token = Str::random(64);

        self::create([
            'user_id' => $user->id,
            'token_hash' => Hash::make($token),
            'expires_at' => now()->addMinutes(30),
            'created_at' => now(),
        ]);

        return $token;
    }

    public static function obtenerRegistroValido(string $token)
    {
        $tokens = self::with('user')->get();

        foreach ($tokens as $registro) {

            if ($registro->isExpired()) {
                continue;
            }

            if (Hash::check($token, $registro->token_hash)) {
                return $registro;
            }
        }

        return null;
    }
}
