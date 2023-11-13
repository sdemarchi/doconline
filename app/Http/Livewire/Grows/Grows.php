<?php

namespace App\Http\Livewire\Grows;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Grow;

class Grows extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idgrowSort, $nombreSort, $cbuSort, $aliasSort, $titularSort, $mailSort, $instagramSort, $celularSort, $idprovinciaSort,
            $localidadSort, $direccionSort, $cpSort, $cod_descSort, $fe_ingresoSort, $observSort, $activoSort;
    public $searchString;

    public function mount(){
        $this->sortField = 'idgrow';
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $grows = $this->_query();
        return view('livewire.grows.grows', compact('grows'));
    }

    private function _query(){
    $grows = Grow::where('idgrow','>',0);
    if($this->searchString != ''){
        if(is_numeric($this->searchString)){
            $grows->where('idgrow', $this->searchString)
                ->orWhere('celular','like', '%' . $this->searchString . '%');
        } else {
            $grows->where('nombre','like', '%' . $this->searchString . '%')
                ->orWhere('mail','like', '%' . $this->searchString . '%')
                ->orWhere('celular','like', '%' . $this->searchString . '%')
                ->orWhere('titular','like', '%' . $this->searchString . '%');
        }

        }
        $this->_setSortClasses();
        return $grows->orderBy($this->sortField,$this->sortDir)->paginate(20);
    }


    public function sort($field){
        $this->sortField = $field;
        if($field == $this->sortField){
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
        }
    }

    private function _setSortClasses(){
        $this->idgrowSort = '';
        $this->nombreSort = '';
        $this->cbuSort = '';
        $this->aliasSort = '';
        $this->titularSort = '';
        $this->mailSort = '';
        $this->instagramSort = '';
        $this->celularSort = '';
        $this->idprovinciaSort = '';
        $this->localidadSort = '';
        $this->direccionSort = '';
        $this->cpSort = '';
        $this->cod_descSort = '';
        $this->fe_ingresoSort = '';
        $this->observSort = '';
        $this->activoSort = '';

        switch($this->sortField){
            case 'idgrow':
                $this->idgrowSort = $this->sortDir;
                break;
            case 'nombre':
                $this->nombreSort = $this->sortDir;
                break;
            case 'cbu':
                $this->cbuSort = $this->sortDir;
                break;
            case 'alias':
                $this->aliasSort = $this->sortDir;
                break;
            case 'titular':
                $this->titularSort = $this->sortDir;
                break;
            case 'mail':
                $this->mailSort = $this->sortDir;
                break;
            case 'instagram':
                $this->instagramSort = $this->sortDir;
                break;
            case 'celular':
                $this->celularSort = $this->sortDir;
                break;
            case 'idprovincia':
                $this->idprovinciaSort = $this->sortDir;
                break;
            case 'localidad':
                $this->localidadSort = $this->sortDir;
                break;
            case 'direccion':
                $this->direccionSort = $this->sortDir;
                break;
            case 'cp':
                $this->cpSort = $this->sortDir;
                break;
            case 'cod_desc':
                $this->cod_descSort = $this->sortDir;
                break;
            case 'fe_ingreso':
                $this->fe_ingresoSort = $this->sortDir;
                break;
            case 'observ':
                $this->observSort = $this->sortDir;
                break;
            case 'activo':
                $this->activoSort = $this->sortDir;
                break;
        }
    }

public function eliminar($idPaciente){
    Grow::find($idPaciente)->delete();
    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el registro del Grow"]);
}

public function resetPagination(){
    $this->resetPage();
}


}
