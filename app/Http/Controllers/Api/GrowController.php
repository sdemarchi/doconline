<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Pago;
use App\Models\Grow;
use App\Models\Paciente;

class GrowController extends Controller
{
    public function getGrowByRoute($url){
        $grow = Grow::where('cod_desc','like', $url)->first();
        return response()->json($grow);
    }

    public function getGrowById($id){
        $grow = Grow::where('idgrow','like', $id)->first();
        return response()->json($grow);
    }

    public function getGrowByEmail($email){
        $grow = Grow::where('mail','like', $email)->first();
        return response()->json($grow);
    }

    public function pago($paciente)
    {
        $ficha = Paciente::where('dni', $paciente->dni)->first();

        $pago = Pago::where('id_paciente', $paciente->id)
        ->latest('created_at')
        ->first();

        $pagoVerificado = false;

        if($pago){
            $pagoVerificado = $pago->verificado;
        };

        if($ficha) {
            return (boolean) $ficha->pagado2023 || $ficha->pagado2024 || $pagoVerificado;
        } else if($pago){
            return (boolean) $pagoVerificado;
        } else
        {
            return (boolean) 0;
        }
    }

    public function getGrowPacientes($id)
    {
        $pacientes = [];
        $growPacientes = Grow::with('pacientes')->find($id);

        $grow = [
            'id' => $growPacientes->idgrow,
            'nombre' => $growPacientes->nombre
        ];

        foreach ($growPacientes->pacientes as $paciente) {
            $pacientePago = $this->pago($paciente);
            $pacientes[] = ['nombre' => $paciente->nombre, 'pago' => $pacientePago,'fecha' => $paciente->created_at];
        }

        $grow['pacientes'] = $pacientes;

        return response()->json($grow);
    }

    public function createGrow(Request $request)
    {
        $original_cod_desc = strtoupper(str_replace([' ', '.'], ['', '-'], $request->nombre));
        $cod_desc = $original_cod_desc;

        $count = 1;
        while (Grow::where('cod_desc', $cod_desc)->exists()) {
            $cod_desc = $original_cod_desc . $count;
            $count++;
        }

        $url = '/' . $cod_desc;
        $fe_ingreso = Carbon::now()->toDateString();

        $grow = [
            'nombre' => $request->nombre,
            'cbu' => $request->cbu,
            'alias' => $request->alias,
            'titular' => $request->titular,
            'mail' => $request->mail,
            'instagram' => $request->instagram,
            'celular' => $request->celular,
            'idprovincia' => $request->idprovincia,
            'localidad' => $request->localidad,
            'direccion' => $request->direccion,
            'cp' => $request->cp,
            'cod_desc' => $cod_desc,
            'fe_ingreso' => $fe_ingreso,
            'activo' => true,
            'url' => $url
        ];

        $newGrow = Grow::create($grow);
        return response()->json($newGrow);
    }

}
