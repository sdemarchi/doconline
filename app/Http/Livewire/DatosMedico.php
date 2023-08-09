<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use Carbon\Carbon;

use App\Models\DatoMedico;

class DatosMedico extends Component
{
    use WithFileUploads;

    public $datoId;
    //public $apeynom, $tipo_nro_doc, $matricula, $especialidad, $domicilio, $tel_part, $tel_cel, $email, $firma, $foto;
    public $datos, $firma, $sello;

    protected $rules = [
        'datos.apeynom' => 'required|max:150',
        'datos.tipo_nro_doc' => 'required|max:50',
        'datos.matricula' => 'required|max:50',
        'datos.especialidad' => 'max:100',
        'datos.domicilio' => 'max:50',
        'datos.tel_part' => 'max:20',
        'datos.tel_cel' => 'max:20',
        'datos.email' => 'max:150',
        'datos.firma' => 'max:150',
        'datos.sello' => 'max:150',
    ];
    
    public function render()
    {
        $this->datos = DatoMedico::find($this->datoId);
        /*$this->apeynom = $datos->apeynom;
        $this->tipo_nro_doc = $datos->tipo_nro_doc;
        $this->matricula = $datos->matricula;
        $this->especialidad = $datos->especialidad;
        $this->domicilio = $datos->domicilio;
        $this->tel_part = $datos->tel_part;
        $this->tel_cel = $datos->tel_cel;
        $this->email = $datos->email;*/
        return view('livewire.datos-medico');
    }

    public function update(){
        $this->validate();
        $this->datos->update();
        /*DatoMedico::find($this->datoId)->update([
            'apeynom' => $this->apeynom,
            'tipo_nro_doc' => $this->tipo_nro_doc,
            'matricula' => $this->matricula,
            'especialidad' => $this->especialidad,
            'domicilio' => $this->domicilio,
            'tel_part' => $this->tel_part,
            'tel_cel' => $this->tel_cel,
            'email' => $this->email,
        ]);*/

        $this->_saveFirma();
        $this->_saveSello();
        
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Los datos se guardaron con éxito"]);
    }

    function _saveFirma()
    {
        $this->validate([
            'firma' => 'max:102400', 
        ]);
        if($this->firma){
            $fileName = 'imagen_'.date_format(Carbon::now(),'Y-m-d_hiu') .'.png';
            $storagePath = storage_path('app/assets/img/uploads/');
            $path = public_path('img/uploads/');
            
            $this->firma->storeAs('assets/img/uploads', $fileName);
            rename($storagePath . $fileName, $path . $fileName);
            
            $this->datos->firma = $fileName;
            $this->datos->save();
            
        }
        
    }

    function _saveSello()
    {
        $this->validate([
            'sello' => 'max:102400', 
        ]);
        if($this->sello){
            $fileName = 'imagen_'.date_format(Carbon::now(),'Y-m-d_hiu') .'.png';
            $storagePath = storage_path('app/assets/img/uploads/');
            $path = public_path('img/uploads/');
            
            $this->sello->storeAs('assets/img/uploads', $fileName);
            rename($storagePath . $fileName, $path . $fileName);
            
            $this->datos->sello = $fileName;
            $this->datos->save();
            
        }
        
    }
}
