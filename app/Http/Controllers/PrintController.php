<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Paciente;
use App\Models\DatoMedico;
use App\Models\Receta;
use App\Lib\CifradoHelper;

class PrintController extends Controller
{
    public function declaracionPaciente($idCifrado){
        $id = CifradoHelper::descifrar($idCifrado);

        $paciente = Paciente::find($id);
        $medico = DatoMedico::first();
        if($paciente->version == 2){ //formulario creado con la app React
            $view = 'pdf.declaracion_v2';
        } else {
            $view = 'pdf.declaracion';
        }
        $pdf = \PDF::loadView($view,compact('paciente','medico'));

        return $pdf->stream("declaracion.pdf");
    }

    public function declaracionPacienteToken($token){
        $paciente = Paciente::where('token',$token)->first();
        if(!$paciente){
            return redirect("https://v2.doconlineargentina.com");
        }
        $medico = DatoMedico::first();
        if($paciente->version == 2){ //formulario creado con la app React
            $view = 'pdf.declaracion_v2';
        } else {
            $view = 'pdf.declaracion';
        }
        $pdf = \PDF::loadView($view,compact('paciente','medico'));

        return $pdf->stream("declaracion.pdf");
    }

    public function consentimientoPaciente($idCifrado){
        $id = CifradoHelper::descifrar($idCifrado);

        $paciente = Paciente::find($id);
        $medico = DatoMedico::first();
        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
        $dateTs = Carbon::createFromFormat('Y-m-d',"$paciente->fe_carga")->timestamp;
        $dia = strftime("%e",$dateTs);
        $mes = strftime("%B",$dateTs);
        $anio = strftime("%G",$dateTs);
        if($paciente->version == 2){ //formulario creado con la app React
            $view = 'pdf.consentimiento_v2';
        } else {
            $view = 'pdf.consentimiento';
        }
        $pdf = \PDF::loadView($view,compact('paciente','medico','dia','mes','anio'));

        return $pdf->stream("consentimiento.pdf");
    }

    public function consentimientoPacienteToken($token){
        $paciente = Paciente::where('token',$token)->first();
        if(!$paciente){
            return redirect("https://v2.doconlineargentina.com");
        }
        $medico = DatoMedico::first();
        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
        $dateTs = Carbon::createFromFormat('Y-m-d',"$paciente->fe_carga")->timestamp;
        $dia = strftime("%e",$dateTs);
        $mes = strftime("%B",$dateTs);
        $anio = strftime("%G",$dateTs);
        if($paciente->version == 2){ //formulario creado con la app React
            $view = 'pdf.consentimiento_v2';
        } else {
            $view = 'pdf.consentimiento';
        }
        $pdf = \PDF::loadView($view,compact('paciente','medico','dia','mes','anio'));

        return $pdf->stream("consentimiento.pdf");
    }

    public function prontoDespacho($id){
        $paciente = Paciente::find($id);
        $pdf = \PDF::loadView('pdf.pronto-despacho',compact('paciente'));

        return $pdf->stream("consentimiento.pdf");
    }

    public function receta($id){
        $receta = Receta::find($id);
        $medico = DatoMedico::first();
        $pdf = \PDF::loadView('pdf.receta',compact('receta', 'medico'));

        return $pdf->stream("receta.pdf");
    }

    public function amparo($idPacienteCifrado){
        $idPaciente = CifradoHelper::descifrar($idPacienteCifrado);

        $paciente = Paciente::find($idPaciente);
        $pdf = \PDF::loadView('pdf.generador-amparo',compact('paciente'));

        $nombreApellidoConGuiones = str_replace(' ', '-', $paciente->nom_ape);

        return $pdf->stream("amparo-" . $nombreApellidoConGuiones . ".pdf");
    }
}
