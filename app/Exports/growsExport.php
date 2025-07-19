<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Grow;

class GrowsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grow::get();
    }

    public function headings(): array
    {
    return ['id','nombre','cbu','alias','titular','mail','instagram','celular','idprovincia',
    'localidad','direccion','cp','cod_desc','fe_ingreso','observ','activo','descuento','url'];
    }

    public function map($grow): array
    {
        return [
            $grow->idgrow,
            $grow->nombre,
            $grow->cbu,
            $grow->alias,
            $grow->titular,
            $grow->mail,
            $grow->instagram,
            $grow->celular,
            $grow->idprovincia,
            $grow->localidad,
            $grow->direccion,
            $grow->cp,
            $grow->cod_desc,
            $grow->fe_ingreso,
            $grow->observ,
            $grow->activo,
            $grow->descuento,
            $grow->url,
        ];
    }
}
