<?php
namespace App\Http\Livewire\Pagos;

use App\Models\Pago;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class PagosList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchString;
    public $verComprobante = false;

    public function render()
    {
        $pagos = $this->_query();
        return view('livewire.pagos.pagos-list', compact('pagos'));
    }

    private function _query()
    {
        $pagos = Pago::query();

        if ($this->searchString != '') {
            $pacientes = Pago::select('id')
                ->where('nombre', 'like', '%' . $this->searchString . '%')
                ->orWhere('dni', $this->searchString)
                ->get()->pluck('id');
            $pagos->whereIn('paciente_id', $pacientes);
        }

        return $pagos
            ->select('*', DB::raw("DATE_FORMAT(created_at, '%d/%m/%y - %H:%ihs') as formatted_created_at"))
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function mostrarComprobante($img){
        $this->comprobanteImg = $img;
        $this->verComprobante = true;
    }

    public function ocultarComprobante(){
        $this->comprobanteImg = '';
        $this->verComprobante = false;
    }

    public function abrirPago($id){
        return redirect()-> route('pago',$id);
    }

    public function handleVerificado($id){
        $pago = Pago::find($id);
        $verificado = $pago->verificado;
        $pago->verificado = !$verificado;
        $pago->save();

    }

    public function eliminar($id){
        $pago = Pago::find($id);
        $pago->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Pago"]);
    }

    public function confirmado($id){
        $pago = Pago::find($id);
        $pago->confirmado = 1;
        $pago->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Pago se marcó como verificado"]);
    }

    public function noConfirmado($id){
        $pago = Pago::find($id);
        $pago->atendido = 0;
        $pago->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Pago se marcó como no verificado"]);
    }

    public function resetPagination(){
        $this->resetPage();
    }

}
