<?php

namespace App\Http\Livewire\Grows;

use Livewire\Component;
use App\Models\TurnoPaciente;
use App\Models\Grow;
use App\Models\Paciente;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GrowEstadisticasLivewire extends Component{
    public function mount(){
        $this->mesActual = date('n');
        $this->anioReferencia = date('Y');
        $this->anioActual = date('Y');
        $this->pacientes = $this->getPacientes();
        $this->growsPacientes = $this->getGrows();
    }

    public function render(){
        return view('livewire.grows.grow-estadisticas-livewire');
    }

    public function refresh(){
        $this->pacientesGrow = [];
        $this->seleccionarGrow(0,null);

        $this->pacientes = $this->getPacientes();
        $this->growsPacientes = $this->getGrows();

        $this->emit('grows-loaded');
    }

    public $growSeleccionado;
    public $pacientes = [];
    public $growsPacientes = [];
    public $pacientesGrow = [];
    public $growsCount;
    public $growSeleccionadoNombre;

    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    public function getPacientes(){
        $pacientesConGrow = TurnoPaciente::whereYear('created_at', $this->anioActual)
        ->whereMonth('created_at', $this->mesActual)
        ->whereNotNull('grow')
        ->select('id', 'dni', 'grow', 'nombre')
        ->get();

        $pacientesConGrow = $pacientesConGrow->map(function ($paciente) {
            $paciente['pago'] = 'No';

            $pac = Paciente::where('dni', $paciente['dni'])->first();
            if ($pac !== null) {
                if ($pac->pagado2023 == 1 || $pac->pagado2024 == 1) {
                    $paciente['pago'] = 'Si';
                } else {
                    $paciente['pago'] = 'No';
                }
            } else {
                $paciente['pago'] = 'No';
            }
            return $paciente;
        });

        $pacientesConGrow = $pacientesConGrow->toArray();

        return $pacientesConGrow;
    }

    public function filtrarPacientes($growId){
        $pacientesFiltrados = [];
        foreach($this->pacientes as $paciente){
            if($paciente['grow'] == $growId){
                $pacientesFiltrados[] = $paciente;
            }
        }
        return $pacientesFiltrados;
    }

    public function getGrows(){
        $grows = [];
        $pagaronMes = 0;
        $noPagaronMes = 0;
        $numPacientes = 0;

        foreach ($this->pacientes as $paciente) {
            $growid = $paciente['grow'];
            $numPacientes++;

            if (!array_key_exists($growid, $grows)) {
                $detalleGrow = Grow::select('nombre')->find($growid);
                $grows[$growid] = [
                    'growid' => $growid,
                    'nombre' => $detalleGrow->nombre,
                    'pacientes' => 0,
                    'pagaron' => 0
                ];
            }

            $grows[$growid]['pacientes']++;

            if ($paciente['pago'] == 'Si') {
                $grows[$growid]['pagaron']++;
                $pagaronMes++;
            }else{
                $noPagaronMes++;
            }
        };

        return ['grows' => array_values($grows), 'pagaronMes' => $pagaronMes, 'noPagaronMes' => $noPagaronMes, 'numPacientes' => $numPacientes];
    }


    public function seleccionarGrow($idGrow,$nombreGrow){
        $this->pacientesGrow = $this->filtrarPacientes($idGrow);
        $this->growSeleccionado = $idGrow;
        $this->growSeleccionadoNombre = $nombreGrow;
    }

    public function abrirFicha($dni){
        $pac = Paciente::where('dni', $dni)->first();

        if ($pac !== null) {
            $url = route('pacientes.edit', $pac->idpaciente);
            return redirect($url);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El paciente no tiene ficha aun"]);
        }
    }

}
