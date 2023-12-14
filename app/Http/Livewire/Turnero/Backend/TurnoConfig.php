<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\TurnoConf;
use App\Models\Prestador;

class TurnoConfig extends Component
{
    public $diaAgregar, $desdeAgregar1, $hastaAgregar1, $desdeAgregar2, $hastaAgregar2,
        $desdeAgregar3, $hastaAgregar3, $duracionTurno, $prestadorDiasDeAnticipacion;
    public $prestadorId = 0;

    protected $rules = [
        'diaAgregar' => 'required',
        'desdeAgregar1' => 'required',
        'hastaAgregar1' => 'required',
        'desdeAgregar2' => 'required',
        'hastaAgregar2' => 'required',
        'desdeAgregar3' => 'required',
        'hastaAgregar3' => 'required',
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
            $dia->hora_desde_1 = $this->desdeAgregar1;
            $dia->hora_hasta_1 = $this->hastaAgregar1;
            $dia->hora_desde_2 = $this->desdeAgregar2;
            $dia->hora_hasta_2 = $this->hastaAgregar2;
            $dia->hora_desde_3 = $this->desdeAgregar3;
            $dia->hora_hasta_3 = $this->hastaAgregar3;
            $dia->duracion_turno = $this->duracionTurno;
            $dia->save();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se actualizó la configuración para el día seleccionado"]);

        } else {
            TurnoConf::create([
                'prestador_id' => $this->prestadorId,
                'dia_semana' => $this->diaAgregar,
                'hora_desde_1' => $this->desdeAgregar1,
                'hora_hasta_1' => $this->hastaAgregar1,
                'hora_desde_2' => $this->desdeAgregar2,
                'hora_hasta_2' => $this->hastaAgregar2,
                'hora_desde_3' => $this->desdeAgregar3,
                'hora_hasta_3' => $this->hastaAgregar3,
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
