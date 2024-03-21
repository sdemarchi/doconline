<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\FormularioCompleto;

use Livewire\WithFileUploads;

use App\Models\TurnoPaciente;
use App\Models\Prestador;
use App\Models\Turno;
use App\Models\Paciente;
use App\Models\PacientePatologia;
use App\Models\Pago;

class Calendario extends Component
{
    use WithFileUploads;

    public $fileTurnos;
    public $pacienteId, $prestadorId, $calendario = [], $mesActual, $anioActual, $mesTexto, $turnos = [],
    $fechaSeleccionada, $turnoSeleccionado, $fechaSelFormateada;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

    public function mount(){

        $this->prestadorId = 1;
        if(session('mesActual')){
            $this->mesActual = session('mesActual');
            $this->anioActual = session('anioActual');
        } else {
            $this->mesActual = Carbon::now()->addDays(3)->format('n');
            $this->anioActual = Carbon::now()->addDays(3)->format('Y');
        }
        if(session('fechaActual')){
            $this->fechaSeleccionada = session('fechaActual');
            if($this->fechaSeleccionada <> '') $this->fechaSelect($this->fechaSeleccionada);
        } else {
            $this->fechaSeleccionada = '';
            $this->fechaSelFormateada = '';
        }
    }

    public function render(){
        $this->prestadorId = 1;
        if(session('mesActual')){
            $this->mesActual = session('mesActual');
            $this->anioActual = session('anioActual');
        } else {
            $this->mesActual = Carbon::now()->addDays(3)->format('n');
            $this->anioActual = Carbon::now()->addDays(3)->format('Y');
        }
        if(session('fechaActual')){
            $this->fechaSeleccionada = session('fechaActual');
            if($this->fechaSeleccionada <> '') $this->fechaSelect($this->fechaSeleccionada);
        } else {
            $this->fechaSeleccionada = '';
            $this->fechaSelFormateada = '';
        }
        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
        $this->emit('calendario-loaded');
        return view('livewire.turnero.backend.calendario');
    }

    private function _armarCalendario(){
        $start = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->startOfMonth()->previous('sunday');
        $end = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth()->next('saturday');
        $period = CarbonPeriod::create($start,$end);
        $diaLimite = Carbon::now()->addDays(0);

        foreach ($period as $date) {
            $inactivo = '';
            $turnos = $this->_tieneTurnosDisp($date) ? 'turnos' : '';
            if($this->_tieneTurnosAsign($date)) $turnos = 'turnosAsign';

            $calend[] = [
                "fecha" => $date->toDateString(),
                "dia" => $date->format('d'),
                "enmes" => $date->format('m') == $this->mesActual ? 'enmes' : '',
                "turnos" => $turnos
            ];
            //echo $date->format('Y-m-d');
        }
        $this->calendario = $calend;
    }

    public function fechaSelect($fecha){
        $this->emit('calendario-loading');
        $this->turnos = [];
        $this->turnoSeleccionado = '';
        $this->fechaSeleccionada = $fecha;
        session(['fechaActual' => $fecha]);
        $this->_getTurnos($fecha);
    }

    public function mesAnterior(){
        if($this->mesActual == 1){
            $this->mesActual = 12;
            $this->anioActual--;
        } else {
            $this->mesActual--;
        }
        session(['mesActual' => $this->mesActual]);
        session(['anioActual' => $this->anioActual]);
        session(['fechaActual' => '']);

        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
    }

    public function booleanToText($value){
        if($value==0){
            return 'No';
        }else if($value==1){
            return 'Si';
        };
    }

    public function copiarTurnos(){
        // Generar HTML con formato
        $html = '<table border="1">
                    <thead>
                    <th style="background-color:white;color:black;">'.$this->fechaSelFormateada.'</th>
                        <tr>
                        <th style="background-color:#a4c2f4;color:black;">Paciente</th>
                        <th style="background-color:#a4c2f4;color:black;">Patologias</th>
                        <th style="background-color:#a4c2f4;color:black;">Pago</th>
                        <th style="background-color:#a4c2f4;color:black;">Hora</th>
                        <th style="background-color:#a4c2f4;color:black;">Telefono</th>
                        <th style="background-color:#a4c2f4;color:black;">DNI</th>
                        <th style="background-color:#a4c2f4;color:black;">Email</th>
                        </tr>
                    </thead>
                <tbody>';




        foreach ($this->turnos as $turno) {
            $html .= '<tr>';
            $patologias = '';
            $pago = '';

            if($turno['patologias'] !== 0){
                if(isset($turno['patologias'][0])){
                    foreach ($turno['patologias'][0] as $patologia){
                        if(isset($patologia["dolencia"])){
                            $patologias .= (string) $patologia["dolencia"] . "  ";
                        }
                    }
                }
            }

            if($turno['pago']){
               if($turno['pago']['verificado']){
                $pago = 'Si';
               };
            }

            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($patologias).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($pago).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars((string)$turno['hora']) .'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars((string)$turno['paciente']).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars((string)$turno['telefono']).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars((string)$turno['dni']).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars((string)$turno['email']).'</td>';

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        //dd($html);

        $this->emit('copiarTurnos', ['html' => $html]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "Turnos copiados en el portapapeles."]);
    }

    public function mesSiguiente(){
        if($this->mesActual == 12){
            $this->mesActual = 1;
            $this->anioActual++;
        } else {
            $this->mesActual++;
        }
        session(['mesActual' => $this->mesActual]);
        session(['anioActual' => $this->anioActual]);
        session(['fechaActual' => '']);

        $this->mesTexto = $this->meses[$this->mesActual-1];
        $this->_armarCalendario();
    }

    private function _tieneTurnosDisp($fecha){
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

    private function _tieneTurnosAsign($fecha){
        $turno = Turno::where('fecha',$fecha)
                ->where('prestador_id',$this->prestadorId)
                ->whereNotNull('paciente_id')
                ->first();
        if($turno) {
            return true;
        } else {
            return false;
        }
    }

    private function _getTurnos($fecha){
        setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish');
        $dateTs = Carbon::createFromFormat('Y-m-d',"$fecha")->timestamp;
        $this->fechaSelFormateada = $this->_formatearFecha($fecha);
        $turnosFecha = Turno::where('fecha',$fecha)
                    ->where('prestador_id',$this->prestadorId)
                    ->orderBy('hora','ASC')->get();

        foreach($turnosFecha as $turno){
            $pago = null;

            if($turno->pago_id){
                $pago = Pago::find($turno->pago_id);
            }

            $date = date_create($fecha . ' ' . $turno->hora);
            if($turno->paciente){
                $fichaDelPaciente = $this->_getFicha($turno->paciente->dni);
                $nombrePaciente = $turno->paciente->nombre;
                $telefono = $turno->paciente->telefono;
                $pacienteId = $turno->paciente->id;
                $fichaId = $fichaDelPaciente['idPaciente'];
                $patologias = $fichaDelPaciente['patologias'];
                $asignado = true;
                $cupon = $turno->cupon;
            } else {
                $patologias = '';
                $nombrePaciente = '';
                $telefono = '';
                $pacienteId = 0;
                $fichaId = 0;
                $asignado = false;
                $cupon =  "-";
            }

            $this->turnos[] = [
                'id' => $turno->id,
                'hora' => date_format($date,"H:i"),
                'patologias' => $patologias,
                'paciente' => $nombrePaciente,
                'telefono' =>$this->formatearTelefono($telefono),
                'asignado' => $asignado,
                'cupon' => $cupon,
                'comprobante_pago' => $turno->comprobante_pago,
                'pacienteId' => $pacienteId,
                'fichaId' => $fichaId,
                'atendido' => $turno->atendido,
                'pedi_captura' => $turno->pedi_captura,
                'mando_captura' => $turno->mando_captura,
                'comentarios' => $turno->comentarios,
                'dni'=>$turno->paciente ? $turno->paciente->dni : "",
                'email'=>$turno->paciente ? $turno->paciente->email : "",
                'pago'=>$pago
            ];
        }
    }

    private function _getFicha($dni){
        $ficha = Paciente::where('dni',$dni)->first();
        $patologiasDelPaciente = '';

        if($ficha){
            $patologias = PacientePatologia::where('dni',$dni)->get();


            return [
                'idPaciente' => $ficha->idpaciente,
                'patologias' => $patologias,
            ];

        } else {
            return ['idPaciente' => 0, 'patologias' => 0];
        }
    }

    public function guardarArchivoTurnos()
    {
        $this->validate([
            'fileTurnos' => 'required',
        ]);

        $fileName = Str::random(30).'.csv';
        $this->fileTurnos->storeAs('imports', $fileName);
        $this->_processTurnos($fileName);
        $this->fileProducts = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los Turnos se importaron con éxito"]);
    }

    private function _processTurnos($file){
        $archivo = storage_path('app/imports/') . $file;
        //dd($archivo);
        $handle = fopen($archivo,"r");

        $header = false;

        while ($csvLine = fgetcsv($handle, 10000, ";")) {

            if ($header) {
                $header = false;
            } else {
                $phpDate = date_create_from_format('d-m-Y',$csvLine[0]);
                $fecha = date_format($phpDate,'Y-m-d');
                //dd($fecha);
                $hora = $csvLine[1];
                Turno::create([
                    'prestador_id' => 1,
                    'fecha' => $fecha,
                    'hora' => $hora
                ]);
            }
        }
        unlink($archivo);
    }

    public function copiarAlPortapapeles($propiedad, $valor) {
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => $propiedad . " copiado al portapapeles"]);
    }

    public function eliminarTurno($id){
        Turno::find($id)->delete();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El turno se eliminó con éxito"]);
    }

    public function cancelarTurno($id){
        $turno = Turno::find($id);
        if($turno->atendido){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "No se puede cancelar un Turno ya atendido"]);
        } else {
            $turno->delete();
            $this->fechaSelect($this->fechaSeleccionada);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se canceló el Turno"]);
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

    public function atendido($id){
        $turno = Turno::find($id);
        $turno->atendido = 1;
        $turno->save();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se marcó como atendido"]);
    }

    public function noAtendido($id){
        $turno = Turno::find($id);
        $turno->atendido = 0;
        $turno->save();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se marcó como no atendido"]);
    }

    public function pediCaptura($id){
        $turno = Turno::find($id);
        $turno->pedi_captura = 1;
        $turno->save();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio guardado"]);
    }

    public function formatearTelefono($numero){
        $numeroLimpio = preg_replace('/[^0-9]/', '', $numero);

        if (substr($numeroLimpio, 0, 1) == '0') {
            $numeroLimpio = substr($numeroLimpio, 1);
        }

        if (substr($numeroLimpio, 0, 2) !== '54') {
            $numeroLimpio = '54' . $numeroLimpio;
        }

        $numeroFinal = '+' . $numeroLimpio;

        return $numeroFinal;
    }

    public function noPediCaptura($id){
        $turno = Turno::find($id);
        $turno->pedi_captura = 0;
        $turno->save();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio guardado"]);
    }

    public function mandoCaptura($id){
        $turno = Turno::find($id);
        $turno-> mando_captura = 1;
        $turno-> save();
        $this-> fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio guardado"]);
    }

    public function notificacion($mensaje){
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => $mensaje]);
    }

    public function noMandoCaptura($id){
        $turno = Turno::find($id);
        $turno->mando_captura = 0;
        $turno->save();
        $this->fechaSelect($this->fechaSeleccionada);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio guardado"]);
    }

    public function guardarComentario($id, $comentario){
        $turno = Turno::find($id);
        $turno->comentarios = $comentario;
        $turno->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio guardado"]);
    }

    public function mailFormulario($pacienteId){
        $paciente = Paciente::find($pacienteId);
        $mailTo = $paciente->email;
        Mail::to($mailTo)->send(new FormularioCompleto($paciente));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se envió la Ficha al Paciente"]);
    }
}
