<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Turno;
use App\Models\Prestador;
use App\Models\Setting;
use App\Models\Cupon;
use App\Models\TurnoConf;

class TurnosController extends Controller
{

    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    public function getPrestadores(){
        $prestadores = Prestador::get();
        return response()->json($prestadores);
    }

    public function getTurno($fecha, $prestadorId){
        $turno = [
            'fecha' => '',
            'hora' => '',
            'detalle' => ''
        ];

        $date = Carbon::createFromFormat('Y-n-d',$fecha);

        $proxTurno = $this->_getProxTurno($date, $prestadorId);

        if($proxTurno){
            $prestador = Prestador::find($prestadorId)->nombre;

            $date = date_create($fecha . ' ' . $proxTurno);
            $fechaFormateada = $this->_formatearFecha($fecha);
            $turno = [
                'fecha' => $fecha,
                'hora' => $proxTurno,
                'detalle' => date_format($date,"H:i") . ' - ' . $fechaFormateada .  ' - ' . $prestador
            ];
        }

        return response()->json($turno);

    }

    private function _formatearFecha($fecha){
        $fechaPhp = date_create($fecha);
        $mes = $this->meses[intval(date_format($fechaPhp,"m"))-1];
        $dia = date_format($fechaPhp,"j");
        $diaTxt = $this->dias[intval(date_format($fechaPhp,"w"))];
        $anio = date_format($fechaPhp,"Y");
        return "$diaTxt $dia de $mes de $anio";
    }

    public function getPrecios(){
        $setting = new Setting;
        $precioTransf = $setting->getSetting('precioTransf');
        $precioMP = $setting->getSetting('precioMP');
        $data = [
            'precioTransf' => $setting->getSetting('precioTransf'),
            'precioMP' => $setting->getSetting('precioMP')
        ];

        return response()->json($data);
    }

    public function aplicarCupon($cupon){
        $cuponValido = Cupon::where('codigo',$cupon)->where('activo',1)->first();
        $data = [
            'valido' => false,
            'descuento' => 0
        ];
        if($cuponValido){
            $data = [
                'valido' => true,
                'descuento' => floatval($cuponValido->descuento)
            ];
        }

        return response()->json($data);
    }


    public function getDatosTransf(){
        $setting = new Setting;
        $cbu = $setting->getSetting('CBU');
        $alias = $setting->getSetting('Alias');
        $data = [
            'cbu' => $cbu,
            'alias' => $alias,
        ];

        return response()->json($data);
    }

    public function confirmarTurno(Request $request){
        $data = [
            'prestador_id' => $request->input('prestador'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'fecha_emision' => Carbon::now(),
            'paciente_id' => $request->input('usuario'),
            'comprobante_pago' => $request->input('comprobante'),
            'cupon' => $request->input('cupon'),
            'importe' => $request->input('importe'),
            'descuento' => $request->input('descuento'),
        ];
        Turno::create($data);

        $data = [
            'error' => 0
        ];

        return response()->json($data);

    }

    public function cancelarTurno($pacienteId){
        Turno::where('paciente_id',$pacienteId)->delete();

        $data = [
            'id' => 0,
            'detalle' => ''
        ];

        return response()->json($data);
    }

    public function getTurnoPaciente($id){
        $turno=Turno::where('paciente_id',$id)->where('atendido',0)->first();
        if($turno){
            $date = date_create($turno->fecha . ' ' . $turno->hora);
            $fechaFormateada = $this->_formatearFecha($turno->fecha);
            $data = [
                'id' => $turno->id,
                'detalle' => date_format($date,"H:i") . ' - ' . $fechaFormateada .  ' - ' . $turno->prestador->nombre
            ];
        } else {
            $data = [
                'id' => 0,
                'detalle' => ''
            ];
        }

        return response()->json($data);
    }

    public function uploadComprobante(Request $request){
        $file = $request->file('file');
        $ext = '.' . $file->getClientOriginalExtension();
        $fileName = 'comprobante_'.date_format(Carbon::now(),'Y-m-d_hiu') . $ext;
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $request->file('file')->storeAs('assets/img/uploads',$fileName);
        rename($storagePath . $fileName, $path . $fileName);

        $data = [
            'error' => 0,
            'filename' => $fileName,
        ];

        return response()->json($data);
    }

    private function _getProxTurno($fecha,$prestador){
        $setting = new Setting;
        $ordenTurnos = $setting->getSetting('OrdenTurnos');

        $conf = $this->_getConfDia($fecha,$prestador);
        if(!$conf) return null;

        $rango = $conf->duracion_turno;
        if($ordenTurnos == 'ASC'){
            $hora = Carbon::createFromFormat('H:i:s', $conf->hora_desde);
            $horaHasta = Carbon::createFromFormat('H:i:s', $conf->hora_hasta);
        } else {
            $hora = Carbon::createFromFormat('H:i:s', $conf->hora_hasta);
            $horaDesde = Carbon::createFromFormat('H:i:s', $conf->hora_desde);
            $hora->subMinutes($rango);
        }

        $end = false;
        while(!$end){
            $turno = Turno::where('fecha',date_format($fecha,'Y-m-d'))
                ->where('hora',date_format($hora,'H:i:s'))
                ->where('prestador_id',$prestador)
                ->first();
            if($turno){
                if($ordenTurnos == 'ASC'){
                    $hora->addMinutes($rango);
                    if($hora > $horaHasta) $end = true;
                } else {
                    $hora->subMinutes($rango);
                    if($hora < $horaDesde) $end = true;
                }
            } else {
                return $hora->format('H:i');
            }
        }

        return null;

    }

    private function _getConfDia($fecha,$prestador){
        $dia = $fecha->format('N');
        $conf = TurnoConf::where('dia_semana',$dia)->where('prestador_id',$prestador)->first();
        return $conf;

    }

}
