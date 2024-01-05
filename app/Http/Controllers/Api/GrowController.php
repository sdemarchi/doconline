<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

    public function pago($dni)
    {
        $ficha = Paciente::where('dni', $dni)->first();
        $patologiasDelPaciente = '';

        if ($ficha) {
            return (boolean) $ficha->pagado2023 || $ficha->pagado2024;
        } else {
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
            $pacientePago = $this->pago($paciente->dni);
            $pacientes[] = ['nombre' => $paciente->nombre, 'pago' => $pacientePago,'fecha' => $paciente->created_at];
        }

        $grow['pacientes'] = $pacientes;

        return response()->json($grow);
    }


}
