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
    public $filtroPagaron = false;
    public $anioReferencia;
    public $mesReferencia;
    public $searchString;
    public $anioSeleccionado = 0;
    public $mesSeleccionado = 0;
    public $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    public $mesesFiltro;

    public function render()
    {
        $pacientes = $this->_query()->paginate(20);
        return view('livewire.turnero.backend.turno-pacientes', compact('pacientes'));
    }

    public function mount()
    {
        $this->anioReferencia = date('Y');
        $this->mesReferencia = date('m');
        $this->mesesFiltro = $this->filtrarMeses();
    }

    public function refresh()
    {
        $this->mesesFiltro = $this->filtrarMeses();
        $this->resetPage();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Filtros aplicados"]);
    }

    public function copiarPacientes(){
        $html = '<table border="1">
                    <thead>
                    <th style="background-color:white;color:black;">Pacientes del turnero</th>
                        <tr>
                            <th style="background-color:#a4c2f4;color:black;"Id</th>
                            <th style="background-color:#a4c2f4;color:black;">Nombre</th>
                            <th style="background-color:#a4c2f4;color:black;">DNI</th>
                            <th style="background-color:#a4c2f4;color:black;">Email</th>
                            <th style="background-color:#a4c2f4;color:black;">Grow</th>
                            <th style="background-color:#a4c2f4;color:black;">Emisión</th>
                            <th style="background-color:#a4c2f4;color:black;">Turno</th>
                        </tr>
                    </thead>
                <tbody>';




        foreach ($this->_query()->get() as $paciente) {
            {
            $ultimoTurno = '';
            $emision = '';
            $nombreGrow = '';

            if($paciente->grow_){
                $nombreGrow = $paciente->grow_->nombre;
            }

            if($paciente->ultimo_turno()){
                $ultimoTurno = (string) date_format(date_create($paciente->ultimo_turno()->fecha),"d/m/Y");
                if($paciente->ultimo_turno()->fecha_emision){
                    $emision =  (string) date_format(date_create($paciente->ultimo_turno()->fecha_emision),"d/m/Y");
                }
            }

            $html .= '<tr>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($paciente->id).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($paciente->nombre).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($paciente->dni) .'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($paciente->email).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($nombreGrow).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($emision).'</td>';
            $html .='<td style="background-color:#e9effc;color:black;text-align:left;">'.htmlspecialchars($ultimoTurno).'</td>';
            $html .= '</tr>';
        }
    }

        $html .= '</tbody></table>';

        $this->emit('copiarPacientes', ['html' => $html]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => "Turnos copiados en el portapapeles."]);
    }


    public function filtrarMeses(){
        if ($this->anioReferencia == $this->anioSeleccionado) {
            return $this->mesReferencia;
        } else {
            return 11;
        }
    }

    private function _query(){
        $pacientes = TurnoPaciente::with('grow_')
        ->where('id', '>', 0);
        //dd($pacientes->first()->grow());

        if($this->filtroPagaron === true){
            $pacientes->where(function ($query) {
                $query->whereIn('dni', function ($subquery) {
                    $subquery->select('dni')
                             ->from('pacientes')
                             ->orWhere('pagado2023', true)
                             ->orWhere('pagado2024', true);
                });
            });
        }

        if ($this->mesSeleccionado && $this->anioSeleccionado) {
            $pacientes->whereYear('created_at', $this->anioSeleccionado)
                      ->whereMonth('created_at', $this->mesSeleccionado);

        } else if($this->anioSeleccionado){
            $pacientes->whereYear('created_at', $this->anioSeleccionado);

        } else if($this->mesSeleccionado){
            $this->anioSeleccionado = $this->anioReferencia;
            $pacientes->whereYear('created_at', $this->anioSeleccionado)
                      ->whereMonth('created_at', $this->mesSeleccionado);
        }

        if ($this->searchString != '') {
            $pacientes->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->searchString . '%')
                      ->orWhere('telefono', 'like', '%' . $this->searchString . '%')
                      ->orWhere('dni', $this->searchString);
            });
        }

        return $pacientes->orderBy('id', 'DESC');
    }

    public function eliminar($id)
    {
        Turno::where('paciente_id', $id)->update(['paciente_id' => null]);
        $paciente = TurnoPaciente::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Paciente"]);
    }
}

