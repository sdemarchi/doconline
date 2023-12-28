<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;

use App\Models\TurnoConf;
use App\Models\Prestador;
use App\Models\DiasExentos;

class TurnoConfig extends Component
{
    public $diaAgregar, $desdeAgregar1, $hastaAgregar1, $desdeAgregar2, $hastaAgregar2,$desdeAgregar3, $hastaAgregar3, $duracionTurno, $prestadorDiasDeAnticipacion;
    public $prestadorId = 0;
    public $diasExentos = [];
    public $fechaAgregarDia;
    public $motivoAgregarDia;

    protected $rules = [
        'diaAgregar' => 'required',
        'desdeAgregar1' => 'required',
        'hastaAgregar1' => 'required',
        'desdeAgregar2' => 'required',
        'hastaAgregar2' => 'required',
        'desdeAgregar3' => 'required',
        'hastaAgregar3' => 'required',
        'duracionTurno' => 'required|numeric|max:120|min:1',
        'diasExentos.*.fecha' => 'required',
        'diasExentos.*.motivo' => ''
    ];

    public function render()
    {
        $this->diasExentos = DiasExentos::get();
        $prestadores = Prestador::get();
        $dias = TurnoConf::where('prestador_id',$this->prestadorId)->orderBy('dia_semana','ASC')->get();
        $this->initDiasDeAnticipacion();
        return view('livewire.turnero.backend.turno-config', compact('dias','prestadores'));
    }

    public function guardarItem($id){
        $this->diasExentos[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los cambios se guardaron con éxito"]);
    }

    public function eliminarDia($id){
            $item = DiasExentos::find($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Item seleccionado"]);
    }

    public function agregarItem(){
        DiasExentos::create([
            'fecha' => $this->fechaAgregarDia,
            'motivo' => $this->motivoAgregarDia
        ]);

        $this->fechaAgregarDia= '';
        $this->motivoAgregarDia = '';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Beneficio se agregó con éxito"]);
    }

    public function initDiasDeAnticipacion(){
        $prestador = Prestador::find(1);
        $this->prestadorDiasDeAnticipacion = $prestador->dias_anticipacion;
    }

    public function setDiasAnticipacion($dias){
        $prestador = Prestador::find(1);
        $prestador->cambiarDiasAnticipacion($dias);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambiaste los dias de anticipacion."]);
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
