<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Paciente;
use App\Models\Ocupacion;
use App\Models\PacientePatologia;

class formController extends Controller
{
    public function guardarFormulario(Request $request){
        $part1 = $request->input('part1');

        $resp = $this->_checkEmail($part1['email']);
        $resp = $this->_checkDni($part1['dni']);
        if($resp != ""){
            $error = [
                'code' => 1,
                'message' => $resp
            ];
            return response()->json($error);
        }

        $data = $this->_get_data($request);
        $id = Paciente::create($data)->idpaciente;

        $patologias = $this->_get_patologias_data($id, $request);
        foreach($patologias as $pat){
            PacientePatologia::create($pat);
        }

        $error = [
			'code' => 0,
			'message' => ''
		];

        return response()->json($error);
    }

    public function actualizarFormulario($id, Request $request){
        $part1 = $request->input('part1');
        $paciente = Paciente::find($id);

        $resp = "";
        if($part1['email'] <> $paciente->email){
            $resp = $this->_checkEmail($part1['email']);
        }
        if($part1['dni'] <> $paciente->dni){
            $resp = $this->_checkDni($part1['dni']);
        }
        if($resp != ""){
            $error = [
                'code' => 1,
                'message' => $resp
            ];
            return response()->json($error);
        }

        $data = $this->_get_data($request);
        Paciente::find($id)->update($data);

        $patologias = $this->_get_patologias_data($id, $request);
        PacientePatologia::where('idpaciente',$id)->delete();
        foreach($patologias as $pat){
            PacientePatologia::create($pat);
        }

        $error = [
			'code' => 0,
			'message' => ''
		];

        return response()->json($error);
    }

    private function _get_data(Request $request){
        Log::debug($request->input());
		$part1 = $request->input('part1');
        $part2 = $request->input('part2');
        $part3 = $request->input('part3');
        $part3b = $request->input('part3b');
        $tut1 = $request->input('tut1');
        $tut2 = $request->input('tut2');
        $firma = array_key_exists('firma',$request->input()) ? $request->input('firma') : '';
        $aclaracion = array_key_exists('aclarac',$request->input()) ? $request->input('aclarac') : '';

        $ocupacion = Ocupacion::find($part2['ocupacion_id'])->ocupacion;

        $esMenor = $part3b['es_menor'];

        $dataPaciente = [
            'fe_carga' => date('Y-m-d'),
            'email' => $part1['email'],
            'nom_ape' => $part1['nom_ape'],
            'dni' => $part1['dni'],
            'fe_nacim' => Carbon::createFromFormat('d-m-Y',str_replace('/','-',$part1['fe_nacim'])),
            'cod_vincu' => $part1['cod_vincu'],
            'edad' => $part1['edad'],
            'domicilio' => $part2['domicilio'],
            'localidad' => $part2['localidad'],
            'idprovincia' => $part2['idprovincia'],
            'cp' => $part2['cp'],
            'ocupacion' => $ocupacion == "Otra" ? $part2['ocupacion'] : $ocupacion,
            'celular' => $part1['celular'],
            'osocial' => $part2['osocial'],
            'comentario' => $part2['comentario'],
            'firma_v2' => $firma,
            'aclaracion_v2' => $aclaracion,
            'arritmia' => $part3['arritmia'],
            'salud_mental' => $part3['salud_mental'],
            'salud_ment_esp' => $part3['salud_ment_esp'],
            'alergia' => $part3['alergia'],
            'embarazada' => $part3['embarazada'],
            'maneja_maq' => $part3['maneja_maq'],
            'patologia' => $part3b['patologia'],
            'idcontacto' => $part3b['idcontacto'],
            'contacto_otro' => array_key_exists('contacto_otro',$part3b) ? $part3b['contacto_otro'] : '',
            'es_menor' => $esMenor,
            'version' => 2, //Versión 2 es el formulario generado desde la app React

        ];

        if($esMenor){
            $dataTutor = [
                'tut_apeynom' => $tut1['tut_apeynom'],
                'tut_tipo_nro_doc' => $tut1['tut_tipo_nro_doc'],
                'tut_fe_nacim' => Carbon::createFromFormat('d-m-Y',str_replace('/','-',$tut1['tut_fe_nacim'])),
                'tut_domicilio' => $tut2['tut_domicilio'],
                'tut_localidad' => $tut2['tut_localidad'],
                'tut_idprovincia' => $tut2['tut_idprovincia'],
                'tut_cp' => $tut2['tut_cp'],
                'tut_vinculo' => $tut2['tut_vinculo'],
                'tut_tel_part' => $tut1['tut_tel_part'],
                'tut_tel_cel' => $tut1['tut_tel_cel'],
                'tut_mail' => $tut1['tut_mail'],
                'tut_osocial' => $tut2['tut_osocial'],
                'tut_osocial' => $tut2['tut_osocial'],
            ];
            $data = array_merge($dataPaciente, $dataTutor);
        } else {
            $data = $dataPaciente;
        }

        return $data;
    }

    private function _get_patologias_data($id, Request $request){
        $part1 = $request->input('part1');
        $patologList = $request->input('patologias');

        $patologias = [];
        foreach($patologList as $pat){
            $patologias[] = [
                'item' => $pat['patolog_id'],
                'dni' => $part1['dni'],
                'idpaciente' => $id,
                'anio_aprox' => $pat['anio_aprox'],
                'medicacion' => $pat['medicacion'],
                'prob_trabajo' => $pat['prob_trabajo'],
                'dolor_intensidad' => $pat['dolor_intensidad'],
                'partes_cuerpo' => $pat['partes_cuerpo'],
                'atenua_dolor' => $pat['atenua_dolor']
            ];
        }

        return $patologias;
    }

    private function _checkEmail($email){
        $result = Paciente::where('email',$email)->first();
        if($result) return "El E-Mail ingresado ya existe";
        return "";
    }

    private function _checkDni($dni){
        $result = Paciente::where('dni',$dni)->first();
        if($result) return "El número de DNI ingresado ya existe";
        return "";
    }


    public function getFormulario($dni){
        $paciente = Paciente::where('dni',$dni)->first();
        if($paciente){
            $patologias = PacientePatologia::where('idpaciente',$paciente->idpaciente)->get();
            $error = ['code' => 0];
            $data = $paciente;
        } else {
            $error = ['code' => 1];
            $data = '';
            $patologias = '';
        }
        return response()->json(['error' => $error, 'data' => $data, 'patologias' => $patologias]);
    }
}
