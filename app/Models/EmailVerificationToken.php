<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EmailVerificationToken extends Model
{
    protected $table = 'email_verification_tokens';

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

    /**
     * Crear token de verificación
     */
    public static function crearToken(TurnoPaciente $user): string
    {
        // eliminar tokens viejos del usuario
        self::where('user_id', $user->id)->delete();

        $token = Str::random(64);

        self::create([
            'user_id' => $user->id,
            'token_hash' => Hash::make($token),
            'expires_at' => now()->addHours(24),
            'created_at' => now(),
        ]);

        return $token;
    }

    /**
     * Verificar email mediante token
     */
    public static function verificarToken(string $token): bool
    {
        $tokens = self::with('user')->get();

        foreach ($tokens as $registro) {

            if ($registro->isExpired()) {
                continue;
            }

            if (Hash::check($token, $registro->token_hash)) {

                $user = $registro->user;

                if (!$user) {
                    return false;
                }

                $user->email_verificado = 1;
                $user->save();

                // eliminar token usado
                $registro->delete();

                return true;
            }
        }

        return false;
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
