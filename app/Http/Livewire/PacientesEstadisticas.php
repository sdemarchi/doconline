<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TurnoPaciente;
use App\Models\ModoContacto;
use App\Models\Paciente;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class PacientesEstadisticas extends Component
{
    public function render()
    {
        return view('livewire.pacientes-estadisticas');
    }

    public function mount(){
        $this->mesActual = date('n');
        $this->anioReferencia = date('Y');
        $this->anioActual = date('Y');
        $this->pacientes = $this->getPacientes();
        $this->contactoPacientes = $this->getContactos();

    }

    public function refresh(){
        $this->seleccionarContacto(0,null);
        $this->pacientes = $this->getPacientes();
        $this->contactoPacientes = $this->getContactos();
        $this->pacientesContacto = [];
        $this->emit('pacientes-contacto-loaded');
    }

    public $contactoSeleccionado;
    public $pacientes = [];
    public $contactoPacientes = [];
    public $pacientesContacto = [];
    public $contactoCount;
    public $contactoSeleccionadoNombre;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    public function getPacientes(){
        $pacientesData = Paciente::whereYear('fe_carga', $this->anioActual)
        ->whereMonth('fe_carga', $this->mesActual)
        ->select('idpaciente', 'dni', 'email', 'nom_ape','pagado2023','celular','idcontacto')
        ->get();

        $pacientes = $pacientesData->map(function ($paciente) {
            $paciente['pago'] = 'No';

            if ($paciente->pagado2023 == 1) {
                $paciente['pago'] = 'Si';
            } else {
                $paciente['pago'] = 'No';
            }

            return $paciente;
        });

        $pacientes = $pacientes->toArray();

        return $pacientes;
    }

    public function filtrarPacientes($contactoId){
        $pacientesFiltrados = [];
        foreach($this->pacientes as $paciente){
            if($paciente['idcontacto'] == $contactoId){
                $pacientesFiltrados[] = $paciente;
            }
        }

        return $pacientesFiltrados;
    }

    public function getContactos(){
        $contactos = [];
        $numPacientes = 0;
        $pagaronMes = 0;
        $noPagaronMes = 0;

        foreach ($this->pacientes as $paciente) {
            $numPacientes++;
            $pagaron = 0;
            $noPagaron = 0;
            $contactoId = $paciente['idcontacto'];

            if ($paciente['pago'] == 'Si') {
                $pagaron++;
                $pagaronMes++;

            } else if ($paciente['pago'] == 'No') {
                $noPagaron++;
                $noPagaronMes++;
            }

            if (array_key_exists($contactoId, $contactos)) {
                $contactos[$contactoId]['pacientes']++;
                $contactos[$contactoId]['pagaron'] += $pagaron;
                $contactos[$contactoId]['no-pagaron'] += $noPagaron;

            } else {
                $detalleContacto = ModoContacto::select('modo_contacto')->find($contactoId);
                if($detalleContacto !== null){
                    $contactos[$contactoId] = [
                        'idcontacto' => $contactoId,
                        'nombre' => $detalleContacto->modo_contacto,
                        'pacientes' => 1,
                        'pagaron' => $pagaron,
                        'no-pagaron' => $noPagaron
                    ];
                }
            }
        }

        return ['contactos'=>$contactos,'pagaronMes'=>$pagaronMes,'noPagaronMes'=>$noPagaronMes,'numPacientes'=>$numPacientes];
    }


    public function seleccionarContacto($idContacto,$nombreContacto){
        $this->pacientesContacto = $this->filtrarPacientes($idContacto);
        $this->contactoSeleccionado = $idContacto;
        $this->contactoSeleccionadoNombre = $nombreContacto;
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
