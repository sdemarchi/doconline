<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\LoginConDniMail;
use App\Models\LoginToken;
use App\Models\Grow;
use App\Models\TurnoPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginDniController extends Controller
{
    public function enviarMail(Request $request)
    {
        $dni = $request->input('dni');

        if (!$dni) {
            return response()->json([
                'ok' => false,
                'message' => 'DNI requerido'
            ], 400);
        }

        $user = TurnoPaciente::where('dni', $dni)->first();

        if (!$user) {
            return response()->json([
                'ok' => false,
                'message' => 'No existe un usuario con ese DNI'
            ], 404);
        }

        $token = LoginToken::crearToken($user);

        $url = 'https://www.doconlineargentina.com/turnero/login-token/' . urlencode($token);

        Mail::to($user->email)
            ->send(new LoginConDniMail(
                $user->nombre,
                $url
            ));

        $email = $user->email;

        [$usuario, $dominio] = explode('@', $email);

        $usuarioCensurado =
            substr($usuario, 0, 2)
            . str_repeat('*', max(strlen($usuario) - 2, 0));

        $emailCensurado = $usuarioCensurado . '@' . $dominio;

        return response()->json([
            'ok' => true,
            'message' => 'Mail enviado',
            'email' => $emailCensurado
        ]);
    }

    public function loginConToken(Request $request)
    {
        $token = $request->input('token');

        if(!$token){
            return response()->json([
                'ok' => false,
                'message' => 'Token requerido'
            ], 400);
        }

        $registro = LoginToken::obtenerRegistroValido($token);

        if(!$registro){
            return response()->json([
                'ok' => false,
                'message' => 'Token inválido o expirado'
            ], 400);
        }

        $usuario = $registro->user;

        if(!$usuario){
            return response()->json([
                'ok' => false,
                'message' => 'Usuario no encontrado'
            ], 400);
        }

        $grow = Grow::where('mail', $usuario->email)->first();

        $growAdminId = $grow ? $grow->idgrow : 0;
        $tipo_grow = $grow ? $grow->tipo_id : 0;

        $registro->delete();

        $user = [
            'id' => $usuario->id,
            'userName' => $usuario->nombre,
            'growAdmin' => $growAdminId,
            'tipoGrow' => $tipo_grow
        ];

        return response()->json([
            'ok' => true,
            'message' => 'Login correcto',
            'user' => $user
        ]);
    }
}
