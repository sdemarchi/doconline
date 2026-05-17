<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Models\TurnoPaciente;
use App\Models\RePassToken;
use Illuminate\Mail\Mailable;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function enviarMail(Request $request)
    {
        $dni = $request->input('dni');

        $paciente = TurnoPaciente::where('dni', $dni)->first();

        if ($paciente) {

            $token = Str::random(40);

            $url = 'https://doconlineargentina.com/turnero/restablecer-password/' . $token;

            $data = [
                'username' => $paciente->username,
                'nombre'   => $paciente->nombre,
                'email'    => $paciente->email,
                'token'    => $token,
                'url'      => $url
            ];

            RepassToken::create($data);

            Mail::to($paciente->email)
                ->send(new ResetPasswordMail($data));

            $email = $paciente->email;
            [$usuario, $dominio] = explode('@', $email);
            $usuarioCensurado = substr($usuario, 0, 2) . str_repeat('*', max(strlen($usuario) - 2, 0));
            $emailCensurado = $usuarioCensurado . '@' . $dominio;

            return response()->json(
                [
                    'message' => 'Ok',
                    'email' => $emailCensurado
                ],
                200,
                [],
                JSON_UNESCAPED_SLASHES
            );
        }

        return response()->json(
            'No existe un paciente con ese DNI',
            404,
            [],
            JSON_UNESCAPED_SLASHES
        );
    }


    public function restablecer(Request $request)
    {
        $validToken = false;
        $success = 'success';
        $data = [$success => false];

        $tokenValue = $request->input('token');
        $password = $request->input('password');


        $token = RePassToken::where('token', $tokenValue)->latest()->first();

        if ($token !== null) {
            if ($token->token === $tokenValue) {
                $validToken = true;
                $email = $token->email;
                $paciente = TurnoPaciente::where('email', $email)->first();
            } else {
                return response()->json($data);
            }
        }

        if ($validToken) {
            if ($paciente !== null) {
                $paciente->password = Hash::make($password);
                $paciente->save();
                $data = [$success => true];
            }
        }

        return response()->json($data);
    }
}
