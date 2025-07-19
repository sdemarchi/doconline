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
    public $horasMesFeriado, $horasMesComunes, $minutosMesFeriado, $minutosMesComunes, $horasMesTotales, $minutosMesTotales;
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
        return $data->orderBy('id','DESC')->paginate(20);
    }

    private function _getHorasEnMes($userId){
        $totalComunes = 0;
        $totalFeriado = 0;
        $total = 0;

        $inicioMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->startOfDay();
        $finMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth()->endOfDay();
        $fechas = ControlHorario::where('user_id',$userId)
                    ->whereNotNull('fin')
                    ->where('inicio', '>=', $inicioMes)
                    ->where('inicio', '<=', $finMes)
                    ->get();

        foreach($fechas as $fecha){

            if($fecha->feriado){
                $inicio = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->inicio);
                $fin = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->fin);
                $diferencia = $inicio->diffInMinutes($fin);

                $totalFeriado += $diferencia;
            }else{
                $inicio = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->inicio);
                $fin = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->fin);
                $diferencia = $inicio->diffInMinutes($fin);

                $totalComunes += $diferencia;
            }

            $inicio = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->inicio);
            $fin = Carbon::createFromFormat('Y-m-d H:i:s',$fecha->fin);
            $diferencia = $inicio->diffInMinutes($fin);
            $total += $diferencia;
        }

        $horasComunes = intval($totalComunes/60);
        $minutosComunes = $totalComunes - $horasComunes * 60;


        $horasFeriado = intval($totalFeriado/60);
        $minutosFeriado = $totalFeriado - $horasFeriado * 60;

        $horas = intval($total/60);
        $minutos = $total - $horas * 60;

        $this->horasMesComunes = $horasComunes;
        $this->horasMesFeriado = $horasFeriado;

        $this->minutosMesComunes = $minutosComunes;
        $this->minutosMesFeriado = $minutosFeriado;

        $this->minutosMesTotales = $minutos;
        $this->horasMesTotales = $horas;

        return $horas . ' horas ' . $minutos . ' minutos ';

    }
}
