<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Receta;
use App\Models\Paciente;

class Recetas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchString;
    public $sortField, $sortList, $paciente_idSort, $fechaSort, $idSort;
    
    public function mount(){
        $this->sortField = 'fecha';
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $recetas = $this->_query();
        return view('livewire.pacientes.recetas', compact('recetas'));
    }

    private function _query(){
        $data = Receta::where('id', '>', 0);
        if($this->searchString != ''){
            $data->where('nombre','like', '%' . $this->searchString . '%')
            ->orWhere('dni','like', '%' . $this->searchString . '%');
        }
        $this->_setSortClasses();
        return $data->orderBy($this->sortField,$this->sortDir)->paginate(10);
    }

    public function sort($field){
        $this->sortField = $field;
        if($field == $this->sortField){
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
        }
    }

    private function _setSortClasses(){
        $this->nombreSort = '';
        $this->fechaSort = '';
        $this->idSort = '';

        switch($this->sortField){
            case 'nombre':
            $this->nombreSort = $this->sortDir;
            break;
        case 'fecha':
            $this->fechaSort = $this->sortDir;
            break;
        case 'id':
            $this->idSort = $this->sortDir;
            break;
        }
    }

    public function resetPagination(){ 
        $this->resetPage();
    }

    public function eliminar($id){
        Receta::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó la receta"]);
    }
}
