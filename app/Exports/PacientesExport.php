<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Paciente;

class PacientesExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Paciente::get();
    }

    public function headings(): array
    {
    return ['id','Cod. Descto.','E-Mail','Celular','Nombre y Apellido','DNI','Fecha Nac.','Domicilio','Localidad',
            'Fecha de Carga','Cod. Vinc.','Contacto','Contacto Otro','Pagado','Pagado 2023','Estado'];
    }   

    public function map($paciente): array
    {
        return [
            $paciente->idpaciente,
            $paciente->cod_descto,
            $paciente->email,
            $paciente->celular,
            $paciente->nom_ape,
            $paciente->dni,
            date_format(date_create($paciente->fe_nacim),"d-m-Y"),
            $paciente->domicilio,
            $paciente->localidad,
            date_format(date_create($paciente->fe_carga),"d-m-Y"),
            $paciente->cod_vincu,
            $paciente->modo_contacto ? $paciente->modo_contacto->modo_contacto : '',
            $paciente->contacto_otro,
            $paciente->pagado ? 'Sí' : 'No',
            $paciente->pagado2023 ? 'Sí' : 'No',
            $paciente->getEstado(),
        ];
    }
}
