<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Paciente;

class PacientesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public $pagado2024;

    public function collection()
    {
        return Paciente::orderBy('idpaciente', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'Cod. Descto.',
            'E-Mail',
            'Celular',
            'Nombre y Apellido',
            'DNI',
            'Fecha Nac.',
            'Provincia',
            'Localidad',
            'Domicilio',
            'Fecha de Carga',
            'Cod. Vinc.',
            'Contacto',
            'Contacto Otro',
            'Pagado 2024',
            'Estado',
            'Trámite',
            'Tipo',
            'Paciente',
            'Profesional',
            'Fecha Modificación',
            'Estado Trámite',
            'Vigencia',
            'Inicio',
            'Fin'
        ];
    }

    public function map($paciente): array
    {
        if ($pago = $paciente->ultimoPago(2024)) {
            $this->pagado2024 = ($pago->verificado || $paciente->pagado2024) ? 'Sí' : '-';
        } else {
            $this->pagado2024 = $paciente->pagado2024 ? 'Sí' : '-';
        }

        $datosTramite = array_fill(0, 8, '');

        if (!empty($paciente->datos_tramite)) {
            $datos = explode("\t", $paciente->datos_tramite);
            $datosTramite = array_pad($datos, 8, '');
        }

        return array_merge([
            $paciente->idpaciente,
            $paciente->cod_descto,
            $paciente->email,
            $paciente->celular,
            $paciente->nom_ape,
            $paciente->dni,
            $paciente->fe_nacim ? date('d-m-Y', strtotime($paciente->fe_nacim)) : '',
            $paciente->provincia ? $paciente->provincia->nombre : '',
            $paciente->localidad,
            $paciente->domicilio,
            $paciente->fe_carga ? date('d-m-Y', strtotime($paciente->fe_carga)) : '',
            $paciente->cod_vincu,
            $paciente->modo_contacto ? $paciente->modo_contacto->modo_contacto : '',
            $paciente->contacto_otro,
            $this->pagado2024,
            $paciente->getEstado(),
        ], $datosTramite);
    }
}
