<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ControlHorario;
use App\Models\User;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class MiRegistroHorario extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userId, $mensaje;
    public $mesActual, $anioActual, $anioReferencia;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    
    public function mount(){
        $this->mesActual = date('n');
        $this->anioReferencia = date('Y');
        $this->anioActual = date('Y');
        $this->userId = Auth::user()->id;
    }

    public function render()
    {
        $horas = $this->_query();
        $misHoras = $this->_getHorasEnMes($this->userId);
        if(session()->has('ok')){
            $this->mensaje = session('ok');
        }
        return view('livewire.usuarios.mi-registro-horario', compact('horas','misHoras'));
    }

    public function refresh(){}

    public function mensaje(){
        if($this->mensaje){
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => $this->mensaje]);
        }
    }

    private function _query(){
        $data = ControlHorario::where('user_id', $this->userId);
        return $data->orderBy('inicio','DESC')->paginate(20);
    }

    private function _getHorasEnMes($userId){
        $total = 0;
        $inicioMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->startOfDay();
        $finMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth()->endOfDay();
        $fechas = ControlHorario::where('user_id',$userId)
                    ->whereNotNull('fin')
                    ->where('inicio', '>=', $inicioMes)
                    ->where('inicio', '<=', $finMes)
                    ->get();
        foreach($fechas as $fecha){
            $inicio = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->inicio);
            $fin = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->fin);
            $diferencia = $inicio->diffInMinutes($fin);
            $total += $diferencia;
        }
        $horas = intval($total/60);
        $minutos = $total - $horas * 60;
        return $horas . ' horas ' . $minutos . ' minutos ';
    }
}
