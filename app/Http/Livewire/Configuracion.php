<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Setting;

class Configuracion extends Component
{
    public $precioTransf, $precioMP, $CBU, $Alias, $OrdenTurnos;

    protected $rules = [
        'precioTransf' => 'required|numeric|max:999999',
        'precioMP' => 'required|numeric|max:999999',
        'CBU' => 'required|max:50',
        'Alias' => 'required|max:100',
        'OrdenTurnos' => '',
    ];

    public function render()
    {
        $setting = new Setting;
        $this->precioTransf = $setting->getSetting('precioTransf');
        $this->precioMP = $setting->getSetting('precioMP');
        $this->CBU = $setting->getSetting('CBU');
        $this->Alias = $setting->getSetting('Alias');
        $this->OrdenTurnos = $setting->getSetting('OrdenTurnos');
        return view('livewire.configuracion');
    }

    public function update(){

        $this->validate();

        $setting = new Setting;
        $setting->setSetting('precioTransf', $this->precioTransf);
        $setting->setSetting('precioMP', $this->precioMP);
        $setting->setSetting('CBU', $this->CBU);
        $setting->setSetting('Alias', $this->Alias);
        $setting->setSetting('OrdenTurnos', $this->OrdenTurnos);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardaron las configuraciones"]);

    }
}
