<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Carbon\Carbon;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

use Illuminate\Http\Request;
use App\Lib\CifradoHelper;

use App\Models\Paciente;
use App\Models\DatoMedico;
use App\Models\Receta;
use App\Models\Grow;
use App\Models\SeguimientoPaciente;


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


    public function amparoWord($idPacienteCifrado)
    {
        $idPaciente = CifradoHelper::descifrar($idPacienteCifrado);

        $paciente = Paciente::find($idPaciente);

        // Renderizamos el Blade
        $html = view('pdf.generador-amparo', compact('paciente'))->render();

        // Reemplazamos los h4 por h4 con estilo inline para negrita
        $html = str_replace('<h4>', '<h4 style="font-weight:bold;">', $html);

        // Crear un documento Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Insertamos el HTML
        Html::addHtml($section, $html, false, false);

        // Nombre del archivo
        $nombreApellidoConGuiones = str_replace(' ', '-', $paciente->nom_ape);
        $fileName = "amparo-" . $nombreApellidoConGuiones . ".docx";

        // Guardamos en memoria y devolvemos como descarga
        $temp_file = tempnam(sys_get_temp_dir(), 'word');
        $phpWordWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $phpWordWriter->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }



    public function seguimientoMedico($idGrowCifrado)
    {
        $idGrow = CifradoHelper::descifrar($idGrowCifrado);
        $medico = DatoMedico::first();
        $segList = SeguimientoPaciente::where('ong_id', $idGrow)
                ->with('paciente')
                ->get();

        if ($segList->isEmpty()) {
            return "No hay seguimientos para este Grow.";
        }

        // usar DOMPDF de Barryvdh
        $pdf = \PDF::loadView('pdf.seguimiento-medico', [
            'segList' => $segList,
            'medico' => $medico
        ]);

        return $pdf->stream("seguimiento_medico.pdf");
    }
}
