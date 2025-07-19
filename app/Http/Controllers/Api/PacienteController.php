<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Paciente;
use App\Models\Provincia;
use App\Models\ModoContacto;
use App\Models\Ocupacion;
use App\Models\Dolencia;

class pacienteController extends Controller
{
    public function getSelectSearch(Request $request){ //Búsqueda de pacientes para Select 2
		$term = $request->term;

        $data = [];
        $pagination = [
            'more' => false
        ];

        if($term != ''){

            $pacientes = Paciente::where('nom_ape','like', "%$term%")
            ->select('idpaciente','nom_ape')->limit(10)->get();

            foreach($pacientes as $p){
                $data[] = [
                    'id' => $p->idpaciente,
                    'text' => $p->nom_ape,
                ];

            }

        }
		return response()->json(['results' => $data, 'pagination' => $pagination]);

	}


	public function getProvincias(){
		$data = Provincia::select(['Id as id', 'Provincia as nombre'])->orderBy('Provincia','ASC')->get();
        return response()->json($data);
	}

    public function getContactos(){
		$data = ModoContacto::select(['idcontacto as id', 'modo_contacto as nombre'])->orderBy('id','ASC')->get();
        return response()->json($data);
	}

    public function getOcupaciones(){
		$data = Ocupacion::select(['id', 'ocupacion as nombre'])->orderBy('nombre','ASC')->get();
        return response()->json($data);
	}

    public function getDolencias(){
		$data = Dolencia::select(['iddolencia as id', 'dolencia as nombre'])->orderBy('nombre','ASC')->get();
        return response()->json($data);
	}

    public function getPaciente($id){
        $data = Paciente::where('idpaciente',$id)
                        ->select(['cod_vincu','res_historia','diagnostico','sintomas','tratam_previo',
                        'justificacion','producto_indicado','cant_plantas'])
                        ->first();
        return response()->json($data);
    }

    public function getPacientesVinculador(){
        $data = Paciente::select(['idpaciente','nom_ape'])
                ->orderBy('idpaciente','desc')
                ->limit(50)
                ->get();
        return response()->json(['items' => $data]);
    }

    public function buscarPacientesVinculador($string){
        if(is_numeric($string)){
            $data = Paciente::where('idpaciente',$string)
                ->orWhere('nom_ape','like', '%' . $string . '%')
                ->select(['idpaciente','nom_ape'])
                ->orderBy('idpaciente','desc')
                ->limit(50)
                ->get();
        } else {
            $data = Paciente::where('nom_ape','like', '%' . $string . '%')
                ->select(['idpaciente','nom_ape'])
                ->orderBy('idpaciente','desc')
                ->limit(50)
                ->get();
        }
        return response()->json(['items' => $data]);
    }
}
