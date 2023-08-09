<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\Setting;

use App\Models\TurnoPaciente;
use App\Models\Prestador;
use App\Models\Turno;

class Turnos extends Component
{
    public $pacienteId, $prestadorId, $calendario = [], $mesActual, $anioActual, $mesTexto, $turnos = [], 
    $fechaSeleccionada, $turnoSeleccionado, $ordenTurnos;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    public function mount(){
        $this->pacienteId = session('pacienteId');
    }
    
    public function render()
    {
        $prestadores = Prestador::get();
        $paciente = TurnoPaciente::find($this->pacienteId);
        $setting = new Setting;
        $this->ordenTurnos = $setting->getSetting('OrdenTurnos'); 
        return view('livewire.turnero.turnos', compact('prestadores','paciente'));
    }

    public function prestadorSelect($id){
        $this->prestadorId = $id;
        $this->fechaSeleccionada = '';
        $this->mesActual = Carbon::now()->addDays(3)->format('n');
        $this->anioActual = Carbon::now()->addDays(3)->format('Y');
        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
    }

    public function fechaSelect($fecha, $inactivo){
        if($inactivo != 'inactivo'){
            $this->turnos = [];
            $this->turnoSeleccionado = '';
            $this->fechaSeleccionada = $fecha;
            $this->_getTurnos($fecha); 
        }
             
    }

    public function turnoSelect($id){
        TurnoPaciente::find($this->pacienteId)->update(['temp_turno' => $id]);
        return redirect()->route('turnero.confirmar');
    }
    
    public function mesAnterior(){
        if($this->mesActual == 1){
            $this->mesActual = 12;
            $this->anioActual--;
        } else {
            $this->mesActual--;
        }
        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
    }

    public function mesSiguiente(){
        if($this->mesActual == 12){
            $this->mesActual = 1;
            $this->anioActual++;
        } else {
            $this->mesActual++;
        }
        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
    }

    private function _armarCalendario(){
        $start = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->startOfMonth()->previous('sunday');
        $end = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth()->next('saturday');
        $period = CarbonPeriod::create($start,$end);
        $diaLimite = Carbon::now()->addDays(3);
        
        foreach ($period as $date) {
            if($date < $diaLimite){
                $inactivo = 'inactivo';
                $tieneTurnos = '';
            } else {
                $inactivo = '';
                $tieneTurnos = $this->_tieneTurnos($date) ? 'turnos' : '';
            
            }
            $calend[] = [
                "fecha" => $date->toDateString(),
                "dia" => $date->format('d'),
                "enmes" => $date->format('m') == $this->mesActual ? 'enmes' : '',
                "inactivo" => $inactivo,
                "turnos" => $tieneTurnos
            ]; 
            //echo $date->format('Y-m-d');
        }
        $this->calendario = $calend;
        //dd($this->calendario);
    }

    private function _tieneTurnos($fecha){
        $turno = Turno::where('fecha',$fecha)
                ->where('prestador_id',$this->prestadorId)
                ->whereNull('paciente_id')
                ->first();
        if($turno) {
            return true;
        } else {
            return false;
        }
    }

    private function _getTurnos($fecha){
        //setlocale(LC_TIME, 'es_Es', 'Spanish_Spain', 'Spanish');
        //$dateTs = Carbon::createFromFormat('Y-m-d',"$fecha")->timestamp;
        $turnosFecha = Turno::where('fecha',$fecha)
                    ->where('prestador_id',$this->prestadorId)
                    ->whereNull('paciente_id')
                    ->orderBy('hora',$this->ordenTurnos)
                    ->limit(1)
                    ->get();
        foreach($turnosFecha as $turno){
            $date = date_create($fecha . ' ' . $turno->hora);
            $fechaFormateada = $this->_formatearFecha($fecha);
            $this->turnos[] = [
                'id' => $turno->id,
                'detalle' => date_format($date,"H:i") . ' - ' . $fechaFormateada .  ' - ' . $turno->prestador->nombre
            ];
        }
        
    }

    private function _formatearFecha($fecha){
        $fechaPhp = date_create($fecha);
        $mes = $this->meses[intval(date_format($fechaPhp,"m"))-1];
        $dia = date_format($fechaPhp,"j");
        $diaTxt = $this->dias[intval(date_format($fechaPhp,"w"))];
        $anio = date_format($fechaPhp,"Y");
        return "$diaTxt $dia de $mes de $anio";
    }
}
