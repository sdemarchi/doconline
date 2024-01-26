<?php

namespace App\Http\Livewire\Pagos;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Pago;

class PagoDetalles extends Component
{
    public $pagoId;

    public $idPaciente;
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

    public function render()
    {
        $this->getPagos();
        return view('livewire.pagos.pago-detalles');
    }

    public function getPagos(){
        $pago = Pago::find($this->pagoId);

        $this->nombrePaciente = $pago->nombre_paciente;
        $this->nombrePagador = $pago->pagador->nombre;
        $this->emailPagador = $pago->email_pagador;
        $this->emailPaciente = $pago->email_paciente;
        $this->nombrePagador = $pago->pagador->nombre;
        $this->monto = round($pago->monto);
        $this->descuento = $pago->descuento;
        $this->montoFinal = round($pago->monto_final);
        $this->comprobante = $pago->comprobante;
        $this->verificado = $pago->verificado;
        $this->utilizado = $pago->utilizado;
        $this->codigo = $pago->codigo;
        $this->grow = $pago->grow->nombre;
        $this->idPaciente = $pago->id_paciente ? $pago->id_paciente : '-';
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
}
