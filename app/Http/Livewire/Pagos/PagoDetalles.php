<?php

namespace App\Http\Livewire\Pagos;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Paciente;
use App\Models\Pago;
use Livewire\WithFileUploads;
use App\Models\Grow;
use App\Models\TurnoPaciente;

class PagoDetalles extends Component
{
    use WithFileUploads;
    public $comprobanteFile;

    protected $debug = true;
    protected $listeners = ['subirComprobante'];

    public $comprobanteForm = false;


    public $pagoId;
    public $idPaciente;
    public $idPagador;
    public $nombrePaciente;
    public $emailPaciente;
    public $nombrePagador;
    public $emailPagador;
    public $monto;
    public $descuento;
    public $montoFinal;
    public $comprobante;
    public $verificado;
    public $utilizado;
    public $codigo;
    public $grow;
    public $pagador;

    public function render()
    {
        $this->getPagos();
        $this->pagador = $this->getPagador();
        return view('livewire.pagos.pago-detalles');
    }

    public function getPagos(){
        $pago = Pago::find($this->pagoId);
        $this->nombrePaciente = $pago->nombre_paciente;
        $this->nombrePagador = $pago->pagador->nombre;
        $this->emailPagador = $pago->email_pagador;
        $this->emailPaciente = $pago->email_paciente;
        $this->nombrePagador = $pago->pagador->nombre;
        $this->monto = '$' . number_format($pago->monto, 0, ',', '.');
        $this->descuento = $pago->descuento;
        $this->montoFinal = '$' . number_format($pago->monto_final, 0, ',', '.');
        $this->comprobante = $pago->comprobante;
        $this->verificado = $pago->verificado;
        $this->utilizado = $pago->utilizado;
        $this->codigo = $pago->codigo;
        $this->grow = $pago->grow ? $pago->grow -> nombre : '-';
        $this->idPaciente = $pago->id_paciente ? $pago->id_paciente : '-';
        $this->idPagador = $pago->id_pagador;
    }

    public function verificadoSwitch(){
        $pago = Pago::find($this->pagoId);
        $pago->verificado = !$pago->verificado;
        $pago->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio aplicado"]);
    }

    public function utilizadoSwitch(){
        $pago = Pago::find($this->pagoId);
        $pago->utilizado = !$pago->utilizado;
        $pago->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambio aplicado"]);
    }

    public function subirComprobante()
    {
        if(!$this->comprobanteFile){
            return $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'No seleccionaste ningun archivo.']);
        }
        $fileName = 'comprobante_' . Carbon::now()->format('Y-m-d_hiu') . '.png';

        $storagePath = storage_path('app/assets/img/uploads/');
        $publicPath = public_path('img/uploads/');

        $this->comprobanteFile->storeAs('assets/img/uploads', $fileName);
        rename($storagePath . $fileName, $publicPath . $fileName);
        $this->foto_firma_img = $fileName;
        $pago = Pago::find($this->pagoId);
        $pago->update([
            'comprobante' => $fileName,
        ]);
        $this->switchForm();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Comprobante guardado']);
    }

    public function getPagador(){
        $pagador_ = TurnoPaciente::find($this->idPagador);
        return $pagador_;
    }

    public function switchForm(){
        $this->comprobanteForm = !$this->comprobanteForm;
    }
}
