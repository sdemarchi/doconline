<?php

namespace App\Http\Livewire\Turnero\Backend;

//use Mail;

use App\Mail\TurnoConfirmado;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;

use App\Models\Turno;
use App\Models\TurnoPaciente;


class TurnosList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchString;

    public function render()
    {
        $turnos = $this->_query();
        return view('livewire.turnero.backend.turnos-list', compact('turnos'));
    }

    private function _query(){
        $turnos = Turno::where('id','>',0);
        if($this->searchString != ''){
            $pacientes = TurnoPaciente::select('id')
                ->where('nombre','like', '%' . $this->searchString . '%')
                ->orWhere('dni',$this->searchString)
                ->get()->toArray();
            $turnos->whereIn('paciente_id', $pacientes);
        }
        return $turnos->orderBy('fecha','DESC')->paginate(10);
    }

    public function eliminar($id){
        $turno = Turno::find($id);
        if($turno->paciente_id){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "No se puede eliminar un Turno ya asignado"]);
        } else {
            $turno->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Turno"]);
        }
    }

    public function cancelar($id){
        $turno = Turno::find($id);
        if($turno->atendido){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "No se puede cancelar un Turno ya atendido"]);
        } else {
            $turno->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se canceló el Turno"]);
        }

    }

    public function atendido($id){
        $turno = Turno::find($id);
        $turno->atendido = 1;
        $turno->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se marcó como atendido"]);
    }

    public function noAtendido($id){
        $turno = Turno::find($id);
        $turno->atendido = 0;
        $turno->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Turno se marcó como no atendido"]);
    }

    public function pruebaMail($id){
        $turno = Turno::find($id);
        $mailTo = $turno->paciente->email;
        Mail::send('email.test',[],
             function($message) use($mailTo){
                $message->to($mailTo)->subject('Doconline - Mensaje de Prueba');
            });
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se  envió mail de prueba"]);
    }

    public function mailConfirmacionTurno($id){
        $turno = Turno::find($id);
        $mailTo = $turno->paciente->email;
        Mail::to($mailTo)->send(new TurnoConfirmado($turno));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se  envió mail de prueba"]);
    }

    public function resetPagination(){
        $this->resetPage();
    }

    public function irCalendario($turnoId){
        $turno = Turno::find($turnoId);
        session(['mesActual' =>  date_format(date_create($turno->fecha),"n")]);
        session(['anioActual' =>  date_format(date_create($turno->fecha),"Y")]);
        session(['fechaActual' => $turno->fecha]);
        return redirect(route('calendario'));
    }
}
