<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{

    public function show(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);
        return response()->json($pago);
    }

    public function buscarPorEmail(Request $request,$email)
    {
        $pago = Pago::where('email_paciente', $email)->orderBy('created_at', 'desc')->first();
        return response()->json($pago);
    }

    public function utilizado(Request $request){
        $id = $request->input('id');
        $utilizado = $request->input('utilizado');

        $pago = Pago::findOrFail($id);
        $pago->utilizado = $utilizado;
        $pago->save();

        return response()->json(['utilizado:' => $pago->utilizado]);
    }

    public function ultimoRegalado(Request $request, $user_id)
    {
        $pago = Pago::where('id_pagador', '=', $user_id)
                    ->where(function ($query) use ($user_id) {
                        $query->where('id_paciente', '!=', $user_id)
                              ->orWhereNull('id_paciente');
                    })
                    ->orderByDesc('created_at')
                    ->first();

        if ($pago) {
            return response()->json($pago);
        } else {
            return response()->json([]);
        }
    }


    public function buscarPorCodigo(Request $request, $codigo){

        $pago = Pago::where('codigo', $codigo)->first();

        if(!$pago){
            return response()->json(['error' => 'Pago no encontrado']);
        }

        return response()->json($pago);
    }

    public function abrirPago(){

    }


    public function nuevoPago(Request $request)
    {
        $codigo = strtoupper(substr(md5(uniqid()), 0, 7));

        $pago = Pago::create([
            'id_paciente' => $request->input('id_paciente'),
            'id_pagador' => $request->input('id_pagador'),
            'id_grow' => $request->input('id_grow'),
            'email_paciente' => $request->input('email_paciente'),
            'email_pagador' => $request->input('email_pagador'),
            'monto' => $request->input('monto'),
            'descuento' => $request->input('descuento'),
            'monto_final' => $request->input('monto_final'),
            'codigo' => $codigo,
            'utilizado' => $request->input('utilizado'),
            'nombre_paciente' => $request->input('nombre_paciente'),
            'comprobante' => $request->input('comprobante')
        ]);

        return response()->json($pago, 201);
    }

}
