<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;

use App\Models\Turno;
use App\Models\TurnoPaciente;
use App\Models\Setting;
use App\Models\Cupon;

class Pagos extends Component
{
    public $cupon, $cuponAplicado, $precioTransf, $precioMP, $importeDescuento;
    public $pacienteId, $turno, $paciente;
    
    public function mount(){
        $this->pacienteId = session('pacienteId');
    }

    public function render()
    {
        $this->paciente = TurnoPaciente::find($this->pacienteId);
        $this->turno = Turno::find($this->paciente->temp_turno);
        if(! $this->turno){
            $this->redirect(route('turnero'));
        }
        if($this->turno->id_cupon){
            $this->cuponAplicado = true;
            $cuponValido = Cupon::find($this->turno->id_cupon);
            if($cuponValido) $this->importeDescuento = $cuponValido->descuento;
        }
        $setting = new Setting;
        $this->precioTransf = $setting->getSetting('precioTransf') - $this->importeDescuento;
        $this->precioMP = $setting->getSetting('precioMP') - $this->importeDescuento;
        $cuponAplicado = $this->turno->id_cupon;
        return view('livewire.turnero.pagos');
    }

    public function aplicarCupon(){
        $this->validate([
            'cupon' => 'required|max:150'
        ]);
        $cuponValido = Cupon::where('codigo',$this->cupon)->where('activo',1)->first();
        if($cuponValido){
            $this->turno->id_cupon = $cuponValido->id;
            $this->turno->descuento = $cuponValido->descuento;
            $this->turno->save();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El cupón se aplicó con éxito"]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "Cupón no válido"]);
        }
    }
}
