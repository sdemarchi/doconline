<?php

namespace App\Http\Livewire\Turnero;

use Livewire\Component;
use Carbon\Carbon;

use Illuminate\Support\Str;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;

use App\Mail\TurnoConfirmado;

use App\Models\Turno;
use App\Models\TurnoPaciente;
use App\Models\Setting;
use App\Models\Cupon;

class Pagar extends Component
{
    use WithFileUploads;

    public $comprobante, $medioPago, $cupon, $precioTransf, $precioMP, $importeDescuento, $CBU, $Alias;
    public $pacienteId, $turno, $paciente;
    public $statusPago, $mensajePago;

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
            $this->importeDescuento = $this->turno->descuento;
        }
        if($this->medioPago == 3){ //Se intentó un pago por Mercadopago
            $this->_setMensajePago();
        }
        $setting = new Setting;
        $this->precioTransf = $setting->getSetting('precioTransf') - $this->importeDescuento;
        $this->precioMP = $setting->getSetting('precioMP') - $this->importeDescuento;
        $this->CBU = $setting->getSetting('CBU');
        $this->Alias = $setting->getSetting('Alias');
        return view('livewire.turnero.pagar');
    }

    private function _setMensajePago(){
        switch($this->statusPago){
            case 1:
                $this->mensajePago = "Pago Exitoso";
                $this->turno->comprobante_pago = "mercadopago";
                $this->turno->save();
                break;
            case 2:
                $this->mensajePago = "Pago Fallido";
                break;
            case 3:
                $this->mensajePago = "Pago Pendiente";
                break;
        }
    }
    
    public function subirComprobante()
    {
        $ext = "." . $this->comprobante->getClientOriginalExtension();
        $fileName = 'comprobante_'.date_format(Carbon::now(),'Y-m-d_hiu') . $ext;
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $this->comprobante->storeAs('assets/img/uploads',$fileName);
        rename($storagePath . $fileName, $path . $fileName);
        
        $this->turno->update(['comprobante_pago' => $fileName ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El comprobante se envió con éxito"]);
    }

    public function updatedComprobante(){
        $ext = "." . $this->comprobante->getClientOriginalExtension();
        $fileName = 'comprobante_'.date_format(Carbon::now(),'Y-m-d_hiu') . $ext;
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $this->comprobante->storeAs('assets/img/uploads',$fileName);
        rename($storagePath . $fileName, $path . $fileName);
        
        $this->turno->update(['comprobante_pago' => $fileName ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El comprobante se envió con éxito"]);
    }

    public function confirmarTurno() {
        $this->turno->update([
            'paciente_id' => $this->pacienteId,
            'fecha_emision' => Carbon::now()
        ]);
        $this->_mailConfirmacionTurno();
        return redirect()->route('turnero.confirmado');
        
    }

    private function _mailConfirmacionTurno(){
        $mailTo = $this->turno->paciente->email;
        Mail::to($mailTo)->send(new TurnoConfirmado($this->turno));
    }
}
