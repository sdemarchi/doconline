<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\TurnoConf;
use App\Models\Prestador;

class TurnoConfig extends Component
{
    public $diaAgregar, $desdeAgregar, $hastaAgregar, $duracionTurno, $prestadorDiasDeAnticipacion;
    public $prestadorId = 0;

    protected $rules = [
        'diaAgregar' => 'required',
        'desdeAgregar' => 'required',
        'hastaAgregar' => 'required',
        'duracionTurno' => 'required|numeric|max:120|min:1'
    ];

    public function render()
    {
        $prestadores = Prestador::get();
        $dias = TurnoConf::where('prestador_id',$this->prestadorId)->orderBy('dia_semana','ASC')->get();
        $this->initDiasDeAnticipacion();
        return view('livewire.turnero.backend.turno-config', compact('dias','prestadores'));
    }

    public function initDiasDeAnticipacion(){
        if($this->prestadorId !== 0){
            $prestador = Prestador::find($this -> prestadorId);
            $this->prestadorDiasDeAnticipacion = $prestador->dias_anticipacion;
        }else{
            $this->prestadorDiasDeAnticipacion = 0;
        }
    }

    public function setDiasAnticipacion($dias){
        if($this->prestadorId !== null){
            $prestador = Prestador::find($this -> prestadorId);
            $prestador->cambiarDiasAnticipacion($dias);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambiaste los dias de anticipacion."]);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Seleccione un prestador."]);
        }

    }

    public function configurarDia(){
        if(!$this->prestadorId){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Seleccione un Prestador"]);
            return;
        }

        $this->validate();
        $dia = TurnoConf::where('prestador_id',$this->prestadorId)->where('dia_semana',$this->diaAgregar)->first();
        if($dia){
            $dia->hora_desde = $this->desdeAgregar;
            $dia->hora_hasta = $this->hastaAgregar;
            $dia->duracion_turno = $this->duracionTurno;
            $dia->save();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se actualizó la configuración para el día seleccionado"]);

        } else {
            TurnoConf::create([
                'prestador_id' => $this->prestadorId,
                'dia_semana' => $this->diaAgregar,
                'hora_desde' => $this->desdeAgregar,
                'hora_hasta' => $this->hastaAgregar,
                'duracion_turno' => $this->duracionTurno
            ]);

            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se agregó la configuración"]);
        }

    }

    public function eliminarItem($id){
        TurnoConf::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó la configuración seleccionada"]);
    }
}
