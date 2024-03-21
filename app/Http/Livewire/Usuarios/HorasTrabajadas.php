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

    public function faltaPagar($userId){
        $inicioMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01");
        $finMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth();
        $noLiquidado = ControlHorario::where('user_id',$userId)
        ->whereNotNull('fin')
        ->where('liquidado', '=', 0)
        ->where('inicio', '>=', $inicioMes)
        ->where('inicio', '>=', $inicioMes)
        ->where('inicio', '<=', $finMes)
        ->get();
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
                    ->whereDate('inicio', '>=', $inicioMes)
                    ->whereDate('inicio', '<=', $finMes)
                    ->get();
        foreach($fechas as $fecha){
            $fecha->liquidado = 1;
            $fecha->save();
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se liquidó el mes para el Usuario seleccionado"]);
    }

    function stringToFloat($horaString) {
        list($horas, $minutos) = explode(':', $horaString);

        $horas = intval($horas);
        $minutos = intval($minutos);

        $valorFloat = $horas + ($minutos / 60.0);

        return $valorFloat;
    }

    function floatToHoursMinutes($floatValue) {
        $totalSeconds = round($floatValue * 3600);
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $formattedTime = gmdate('H:i', $hours * 3600 + $minutes * 60);

        return $formattedTime;
    }


    private function _getHorasTrabajadas(){
        $usuarios = User::get();
        foreach($usuarios as $usuario){
            $faltaPagarDias = $this->faltaPagar($usuario->id);
            $horasUsuario = $this->_getHorasEnMes($usuario->id);

            $horasTotales = $this->stringToFloat($horasUsuario['horas']);
            $horasFeriado = $this->stringToFloat($horasUsuario['feriado']);
            $faltanPagarHoras = $horasUsuario['faltanPagarHoras'];

            $horasFeriado_ =  $this->floatToHoursMinutes($horasFeriado);

            $aPagar = number_format(($horasTotales + $horasFeriado)  * $usuario->pago_hora, 0, ',', '.');
            $faltaPagar =  number_format($faltanPagarHoras * $usuario->pago_hora, 0, ',', '.');

            if($horasFeriado_ === '00:00'){
                $horasFeriado_ = '-';
            };

            $horas[] = [
                'id' => $usuario->id,
                'nombre' => $usuario->name,
                'horas' => $horasUsuario['horas'],
                'horas_feriado'=>$horasFeriado_,
                'paga'=>$aPagar,
                'falta_pagar'=>$faltaPagar,
            ];
        }
        return $horas;
    }

    private function _getHorasEnMes($userId)
    {
        $total = 0;
        $totalFeriado = 0;
        $faltanPagar = 0;

        $inicioMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->startOfDay();
        $finMes = Carbon::createFromFormat('Y-n-d',"$this->anioActual-$this->mesActual-01")->endOfMonth()->endOfDay();
        $fechas = ControlHorario::where('user_id', $userId)
            ->whereNotNull('fin')
            ->where('inicio', '>=', $inicioMes)
            ->where('inicio', '<=', $finMes)
            ->get();

        foreach ($fechas as $fecha) {
            $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $fecha->inicio);
            $fin = Carbon::createFromFormat('Y-m-d H:i:s', $fecha->fin);
            $diferencia = $inicio->diffInMinutes($fin);

            if($fecha->liquidado == 0 && $fecha->feriado == 1){
                $faltanPagar += (2 * $diferencia);
            }else if($fecha->liquidado == 0){
                $faltanPagar += $diferencia;
            }

            if ($fecha->feriado == 1) {
                $totalFeriado += $diferencia;
            }

            $total += $diferencia;
        }

        $horas = str_pad(intval($total / 60), 2, 0, STR_PAD_LEFT);
        $minutos = str_pad($total - $horas * 60, 2, 0, STR_PAD_LEFT);

        $horasFeriado = str_pad(intval($totalFeriado / 60), 2, 0, STR_PAD_LEFT);
        $minutosFeriado = str_pad($totalFeriado - $horasFeriado * 60, 2, 0, STR_PAD_LEFT);

        return [
            "horas" => $horas . ':' . $minutos,
            "feriado" => $horasFeriado . ':' . $minutosFeriado,
            "faltanPagarHoras"=> $faltanPagar / 60,
        ];
    }

}
