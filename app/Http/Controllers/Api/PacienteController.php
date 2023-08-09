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
}