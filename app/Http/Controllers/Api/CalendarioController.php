<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\Setting;
use App\Models\Turno;
use App\Models\Prestador;
use App\Models\TurnoConf;

class CalendarioController extends Controller
{
    public function getCalendario($mes,$anio,$prestador){
        $start = Carbon::createFromFormat('Y-n-d',"$anio-$mes-01")->startOfMonth()->previous('sunday');
        $end = Carbon::createFromFormat('Y-n-d',"$anio-$mes-01")->endOfMonth()->next('saturday');
        $period = CarbonPeriod::create($start,$end);
        $prestador_model = Prestador::find($prestador);
        $diaLimite = Carbon::now()->addDays($prestador_model->dias_anticipacion);

        $key = 1;
        $lineaKey = 1;
        $posicion = 1;

        foreach ($period as $date) {
            if($date < $diaLimite){
                $activo = false;
                $tieneTurnos = false;
            } else {
                $activo = true;
                $tieneTurnos = $this->_tieneTurnos($date,$prestador);
            }

            $linea[] = [
                "fecha" => $date->toDateString(),
                "dia" => $date->format('d'),
                "enmes" => $date->format('m') == $mes ? true : false,
                "activo" => $activo,
                "turnos" => $tieneTurnos,
                "key" => $key
            ];

            if($posicion == 7){
                $calend[] = [
                    "linea" => $linea,
                    "key" => $lineaKey
                ];

                $linea = [];
                $posicion = 1;
                $lineaKey++;
            } else {
                $posicion++;
            }
            $key++;
        }

        return response()->json($calend);
    }

    /*private function _tieneTurnos($fecha,$prestador){
        if($prestador==0) return false;
        $turno = Turno::where('fecha',$fecha)
                ->where('prestador_id',$prestador)
                ->whereNull('paciente_id')
                ->first();
        if($turno) {
            return true;
        } else {
            return false;
        }
    }*/

    private function _tieneTurnos($fecha,$prestador){ //Con el nuevo sistema de turnos
        $turno = $this->_getProxTurno($fecha,$prestador);
        if($turno){
            return true;
        } else {
            return false;
        }
    }

    private function _getProxTurno($fecha,$prestador){
        $setting = new Setting;
        $ordenTurnos = $setting->getSetting('OrdenTurnos');

        $conf = $this->_getConfDia($fecha,$prestador);
        if(!$conf) return null;

        $rango = $conf->duracion_turno;
        if($ordenTurnos == 'ASC'){
            $hora = Carbon::createFromFormat('H:i:s', $conf->hora_desde_1);
            $horaHasta = Carbon::createFromFormat('H:i:s', $conf->hora_hasta_1);
        } else {
            $hora = Carbon::createFromFormat('H:i:s', $conf->hora_hasta_1);
            $horaHasta = Carbon::createFromFormat('H:i:s', $conf->hora_desde_1);
            $hora->subMinutes($rango);
        }

        $end = false;

        while(!$end){
            $turno = Turno::where('fecha',$fecha)
                ->where('hora',$rango)
                ->where('prestador_id',$prestador)
                ->first();
            if($turno){
                if($conf == 'ASC'){
                    $hora->addMinutes($rango);
                    if($hora > $horaHasta) $end = true;
                } else {
                    $hora->subMinutes($rango);
                    if($hora < $horaDesde) $end = true;
                }
            } else {
                return $hora;
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

