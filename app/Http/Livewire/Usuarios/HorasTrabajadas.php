<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ControlHorario;
use App\Models\User;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HorasTrabajadas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userId, $usuarios, $mesActual, $anioActual, $anioReferencia;
    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    public function mount(){
        $this->mesActual = date('n');
        $this->anioReferencia = date('Y');
        $this->anioActual = date('Y');
        $this->usuarios = User::select('id','name')->orderBy('name','ASC')->get();
    }

    public function render()
    {
        $horas = $this->_query();
        $usuariosHoras = $this->_getHorasTrabajadas();
        return view('livewire.usuarios.horas-trabajadas', compact('horas','usuariosHoras'));
    }

    private function _query(){
        $data = ControlHorario::where('id', '>', 0);
        if($this->userId > 0){
            $data->where('user_id',$this->userId);
        }
        return $data->orderBy('inicio','DESC')->paginate(20);
    }

    public function liquidado($id){
        ControlHorario::find($id)->update(['liquidado' => 1]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El período seleccionado se marcó como liquidado"]);
    }

    public function noLiquidado($id){
        ControlHorario::find($id)->update(['liquidado' => 0]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El período seleccionado se marcó como no liquidado"]);
    }

    public function resetPagination(){
        $this->resetPage();
    }

    public function refresh(){

    }

    public function liquidarMes($userId){
        $inicioMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01");
        $finMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth();
        $fechas = ControlHorario::where('user_id',$userId)
                    ->whereNotNull('fin')
                    ->where('inicio', '>=', $inicioMes)
                    ->where('inicio', '<=', $finMes)
                    ->get();
        foreach($fechas as $fecha){
            $fecha->liquidado = 1;
            $fecha->save();
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se liquidó el mes para el Usuario seleccionado"]);
    }

    private function _getHorasTrabajadas(){
        $usuarios = User::get();
        foreach($usuarios as $usuario){
            $horasUsuario = $this->_getHorasEnMes($usuario->id);
            $horas[] = [
                'id' => $usuario->id,
                'nombre' => $usuario->name,
                'horas' => $horasUsuario
            ];
        }
        return $horas;
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
        $horas = str_pad(intval($total/60), 2, 0, STR_PAD_LEFT);
        $minutos = str_pad($total - $horas * 60, 2, 0, STR_PAD_LEFT);
        return $horas . ':' . $minutos;
    }
}
