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
        $email = $request->input('email');
        $paciente = TurnoPaciente::where('email', $email)->first();
        $token = Str::random(40);
        $url = 'http://localhost:5173/turnero/restablecer-password/'.$token;
        if ($paciente) {
            $data = [
                'username' => $paciente->username,
                'nombre' => $paciente->nombre,
                'email' => $paciente->email,
                'token' => $token,
                'url'=> $url
            ];

            $repassToken = RepassToken::create($data);

            Mail::to($paciente->email)->send(new ResetPasswordMail($data));

            return response()->json('Ok', 200, [], JSON_UNESCAPED_SLASHES);
        }
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
