<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Str;

use App\Lib\convertBase30;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\PacientesExport;

use App\Models\Paciente;


class Pacientes extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sortField, $sortDir, $idpacienteSort, $fe_cargaSort, $fe_aprobacionSort, $pagado2023Sort, $estadoSort, $idcontactoSort,
            $contacto_otroSort, $nom_apeSort, $dniSort, $cod_vincuSort, $edadSort, $ocupacionSort, $patologiaSort,
            $res_historiaSort, $diagnosticoSort, $tratamientoSort, $justificacionSort, $beneficiosSort, $comentarioSort,
            $doloresSort, $conc_thcSort, $conc_cbdSort, $cant_plantasSort, $dosisSort, $frecuenciaSort, $domicilioSort,
            $localidadSort, $idprovinciaSort, $cpSort, $fe_nacimSort, $osocialSort, $emailSort, $celularSort, $es_menorSort,
            $tut_apeynomSort, $tut_tipo_nro_docSort, $tut_vinculoSort;
    public $searchMode, $searchString;

    public function mount(){
        $this->searchString = session('pacienteSearchString');
        $this->searchMode = session('pacienteSearchMode');
        $this->sortField = 'idpaciente';
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $pacientes = $this->_query();
        return view('livewire.pacientes.pacientes', compact('pacientes'));
    }

    private function _query(){
        session(['pacienteSearchString' => $this->searchString]);
        session(['pacienteSearchMode' => $this->searchMode]);

        $pacientes = Paciente::where('idpaciente','>',0);

        if($this->searchMode == 'datos'){
            if($this->searchString != ''){
                if(is_numeric($this->searchString)){
                    $pacientes->where('idpaciente', $this->searchString)
                        ->orWhere('email','like', '%' . $this->searchString . '%')
                        ->orWhere('celular','like', '%' . $this->searchString . '%');
                } else {
                    $pacientes->where('nom_ape','like', '%' . $this->searchString . '%')
                        ->orWhere('email','like', '%' . $this->searchString . '%')
                        ->orWhere('celular','like', '%' . $this->searchString . '%');
                }
            }
        }

        if($this->searchMode == 'dni'){
            if($this->searchString != ''){
                $pacientes->where('dni', $this->searchString);
            }
        }
        
        $this->_setSortClasses();
        $this->emit('searchCompleted');
        return $pacientes->orderBy($this->sortField,$this->sortDir)->paginate(10);
    }

    public function limpiarBusqueda(){
        $this->resetPagination();
        $this->searchMode = '';
        $this->searchString = '';
    }
        
    public function buscarPorDatos(){
        $this->resetPagination();
        $this->searchMode = 'datos';
    }

    public function buscarPorDNI(){
        $this->resetPagination();
        $this->searchMode = 'dni';
    }

    public function convertirFirmaAclaracion($id){
        $paciente = Paciente::find($id);
        if(!$paciente->firma || !$paciente->aclaracion){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => "No existe la Firma o la Aclaración"]);
            return;
        }
        $convert = new ConvertBase30();
        $rootDir = storage_path('app/imports/');
        $fileName = Str::random(30).'.png';
        $imagenFirma = "data:image/png;base64," . $convert->convertSignBase30ToPng($paciente->firma , 300, 160, '#000000', $rootDir, $fileName);
        $imagenAclaracion = "data:image/png;base64," . $convert->convertSignBase30ToPng($paciente->aclaracion , 300, 160, '#000000', $rootDir, $fileName);
        $paciente->firma_v2 = $imagenFirma;
        $paciente->aclaracion_v2 = $imagenAclaracion;
        $paciente->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "La firma y aclaración se importaron correctamente"]);
    }

    public function sort($field){
        $this->sortField = $field;
        if($field == $this->sortField){
            $this->sortDir = $this->sortDir == 'ASC' ? 'DESC' : 'ASC';
        }
    }

    private function _setSortClasses(){
        $this->idpacienteSort = '';
        $this->fe_cargaSort = '';
        $this->fe_aprobacionSort = '';
        $this->pagado2023Sort = '';
        $this->estadoSort = '';
        $this->idcontactoSort = '';
        $this->contacto_otroSort = '';
        $this->nom_apeSort = '';
        $this->dniSort = '';
        $this->cod_vincuSort = '';
        $this->edadSort = '';
        $this->ocupacionSort = '';
        $this->patologiaSort = '';
        $this->res_historiaSort = '';
        $this->diagnosticoSort = '';
        $this->tratamientoSort = '';
        $this->justificacionSort = '';
        $this->beneficiosSort = '';
        $this->comentarioSort = '';
        $this->doloresSort = '';
        $this->conc_thcSort = '';
        $this->conc_cbdSort = '';
        $this->cant_plantasSort = '';
        $this->dosisSort = '';
        $this->frecuenciaSort = '';
        $this->domicilioSort = '';
        $this->localidadSort = '';
        $this->idprovinciaSort = '';
        $this->cpSort = '';
        $this->fe_nacimSort = '';
        $this->osocialSort = '';
        $this->emailSort = '';
        $this->celularSort = '';
        $this->es_menorSort = '';
        $this->tut_apeynomSort = '';
        $this->tut_tipo_nro_docSort = '';
        $this->tut_vinculoSort = '';

        switch($this->sortField){
            case 'idpaciente':
                $this->idpacienteSort = $this->sortDir;
                break;
            case 'fe_carga':
                $this->fe_cargaSort = $this->sortDir;
                break;
            case 'fe_aprobacion':
                $this->fe_aprobacionSort = $this->sortDir;
                break;
            case 'pagado2023':
                $this->pagado2023Sort = $this->sortDir;
                break;
            case 'estado':
                $this->estadoSort = $this->sortDir;
                break;
            case 'idcontacto':
                $this->idcontactoSort = $this->sortDir;
                break;
            case 'contacto_otro':
                $this->contacto_otroSort = $this->sortDir;
                break;
            case 'nom_ape':
                $this->nom_apeSort = $this->sortDir;
                break;
            case 'dni':
                $this->dniSort = $this->sortDir;
                break;
            case 'cod_vincu':
                $this->cod_vincuSort = $this->sortDir;
                break;
            case 'edad':
                $this->edadSort = $this->sortDir;
                break;
            case 'ocupacion':
                $this->ocupacionSort = $this->sortDir;
                break;
            case 'patologia':
                $this->patologiaSort = $this->sortDir;
                break;
            case 'res_historia':
                $this->res_historiaSort = $this->sortDir;
                break;
            case 'diagnostico':
                $this->diagnosticoSort = $this->sortDir;
                break;
            case 'tratamiento':
                $this->tratamientoSort = $this->sortDir;
                break;
            case 'justificacion':
                $this->justificacionSort = $this->sortDir;
                break;
            case 'beneficios':
                $this->beneficiosSort = $this->sortDir;
                break;
            case 'comentario':
                $this->comentarioSort = $this->sortDir;
                break;
            case 'dolores':
                $this->doloresSort = $this->sortDir;
                break;
            case 'conc_thc':
                $this->conc_thcSort = $this->sortDir;
                break;
            case 'conc_cbd':
                $this->conc_cbdSort = $this->sortDir;
                break;
            case 'cant_plantas':
                $this->cant_plantasSort = $this->sortDir;
                break;
            case 'dosis':
                $this->dosisSort = $this->sortDir;
                break;
            case 'frecuencia':
                $this->frecuenciaSort = $this->sortDir;
                break;
            case 'domicilio':
                $this->domicilioSort = $this->sortDir;
                break;
            case 'localidad':
                $this->localidadSort = $this->sortDir;
                break;
            case 'idprovincia':
                $this->idprovinciaSort = $this->sortDir;
                break;
            case 'cp':
                $this->cpSort = $this->sortDir;
                break;
            case 'fe_nacim':
                $this->fe_nacimSort = $this->sortDir;
                break;
            case 'osocial':
                $this->osocialSort = $this->sortDir;
                break;
            case 'email':
                $this->emailSort = $this->sortDir;
                break;
            case 'celular':
                $this->celularSort = $this->sortDir;
                break;
            case 'es_menor':
                $this->es_menorSort = $this->sortDir;
                break;
            case 'tut_apeynom':
                $this->tut_apeynomSort = $this->sortDir;
                break;
            case 'tut_tipo_nro_doc':
                $this->tut_tipo_nro_docSort = $this->sortDir;
                break;
            case 'tut_vinculo':
                $this->tut_vinculoSort = $this->sortDir;
                break;
        }
    }

    public function eliminar($idPaciente){
        Paciente::find($idPaciente)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el registro del Paciente"]);
    }

    public function resetPagination(){
        $this->emit('inSearch');
        $this->resetPage();
    }

    public function generarCsv(){
        return Excel::download(new PacientesExport, 'pacientes.csv');
    }
}
