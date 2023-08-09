<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

use App\Models\Grow;
use App\Models\Provincia;

class FormGrow extends Component
{
    public $nombre, $cbu, $alias, $titular, $mail, $instagram, $celular, $celularConf, $idprovincia, 
    $localidad, $direccion, $cp, $cod_desc, $fe_ingreso;
    
    protected $rules = [
        'nombre' => 'required|max:100',
        'cbu' => 'max:22',
        'alias' => 'max:100',
        'titular' => 'max:150',
        'mail' => 'email|max:50',
        'instagram' => 'max:150',
        'celular' => 'required|max:11',
        'idprovincia' => '',
        'localidad' => 'max:60',
        'direccion' => 'max:50',
        'cp' => 'max:12',
        'cod_desc' => 'max:30',
        'fe_ingreso' => '',

    ];

    public function mount(){
        $this->fe_ingreso = date('Y-m-d');
    }

    public function render()
    {
        $provincias = Provincia::orderBy('Provincia', 'ASC')->get();
        return view('livewire.front.form-grow', compact('provincias'));
    }

    public function update(){
        $this->validate();
        if($this->celular <> $this->celularConf){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "El celular no coincide con la confirmación"]);
            return;
        }
        $dataGrow=[
            'nombre' => $this->nombre,
            'cbu' => $this->cbu,
            'alias' => $this->alias,
            'titular' => $this->titular,
            'mail' => $this->mail,
            'instagram' => $this->instagram,
            'celular' => $this->celular,
            'idprovincia' => $this->idprovincia,
            'localidad' => $this->localidad,
            'direccion' => $this->direccion,
            'cp' => $this->cp,
            'cod_desc' => $this->cod_desc,
            'fe_ingreso' => $this->fe_ingreso,
        ];
        Grow::create($dataGrow);

        return redirect(route('grow.success'));
        
    }
}
