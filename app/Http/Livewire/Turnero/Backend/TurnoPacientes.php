<?php

namespace App\Http\Livewire\Turnero\Backend;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\TurnoPaciente;
use App\Models\Turno;

class TurnoPacientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchString;
    
    public function render()
    {
        $pacientes = $this->_query();
        return view('livewire.turnero.backend.turno-pacientes',compact('pacientes'));
    }

    private function _query(){
        $pacientes = TurnoPaciente::where('id','>',0);
        if($this->searchString != ''){
            $pacientes->where('nombre','like', '%' . $this->searchString . '%')
                ->orWhere('telefono','like', '%' . $this->searchString . '%')
                ->orWhere('dni',$this->searchString);
        }
        return $pacientes->orderBy('id','DESC')->paginate(10);
    }

    public function eliminar($id){
        Turno::where('paciente_id',$id)->update(['paciente_id' => null]);
        $paciente = TurnoPaciente::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Paciente"]);
    }

    public function resetPagination(){ 
        $this->resetPage();
    }

}
