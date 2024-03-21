<?php
namespace App\Http\Livewire\Grows;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Imagine;
use Intervention\Image\Facades\Image;

use Livewire\Component;
use Livewire\WithFileUploads;

use Carbon\Carbon;

use App\Models\TurnoPaciente;
use App\Models\Grow;
use App\Models\Paciente;
use App\Models\Provincia;
use App\Models\Pago;

use chillerlan\QRCode\{QRCode, QROptions};

class GrowEdit extends Component
{
    use WithFileUploads;

    public $nombre, $cbu, $alias, $titular, $mail, $instagram, $celular, $idprovincia,
    $localidad, $direccion, $cp, $cod_desc = '', $fe_ingreso, $observ, $activo, $imagen1, $imagen2;
    public $codigoQR;

    public $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public $imagen1_path, $imagen2_path,$url;
    public $growId;
    public $linkDeRastreo = '';
    public $descuento = 18;
    public $qrImage;
    public $qrFrame;
    public $pacientes = [];
    public $mesActual;
    public $anioActual;
    public $anioReferencia;
    public $pacientesMes = 0;
    public $pagaronMes = 0;
    public $growsPacientes = [];
    public $imageQR;
    protected $listeners = ['imagenCopiada' => 'notificarImagenCopiada'];

    //------------- QR Functions -------------//

    public function generarCodigoQR(){
        if($this->linkDeRastreo){
            $this->codigoQR = (new QRCode)->render($this->linkDeRastreo);
        }
    }

    //---------------------------------------//


    public function notificarImagenCopiada(){
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "QR copiado al portapapeles"]);
    }

    protected $rules = [
        'nombre' => 'required|max:100',
        'cbu' => 'max:22',
        'alias' => 'max:100',
        'titular' => 'max:150',
        'mail' => 'email|max:50',
        'instagram' => 'max:150',
        'celular' => 'max:11',
        'idprovincia' => '',
        'localidad' => 'max:60',
        'direccion' => 'max:50',
        'cp' => 'max:12',
        'cod_desc' => 'max:30',
        'fe_ingreso' => '',
        'observ' => 'max:1000',
        'url'=>'max:25',
        'activo' => '',
        'imagen1_path' => '',
        'imagen2_path' => '',
    ];

    public function refresh(){
        if($this->growId){
            $this->growsPacientes = $this->getPacientes();
        }
    }

    public function mount(){
        $this->mesActual = date('n');
        $this->anioReferencia = date('Y');
        $this->anioActual = date('Y');

        if($this->growId){
            $grow = Grow::find($this->growId);
            $this->growsPacientes = $this->getPacientes();

            $this->nombre = $grow->nombre;
            $this->cbu = $grow->cbu;
            $this->alias = $grow->alias;
            $this->titular = $grow->titular;
            $this->mail = $grow->mail;
            $this->instagram = $grow->instagram;
            $this->celular = $grow->celular;
            $this->idprovincia = $grow->idprovincia;
            $this->localidad = $grow->localidad;
            $this->direccion = $grow->direccion;
            $this->cp = $grow->cp;
            $this->cod_desc = $grow->cod_desc;
            $this->fe_ingreso = $grow->fe_ingreso;
            $this->observ = $grow->observ;
            $this->activo = $grow->activo;
            $this->imagen1_path = $grow->imagen1;
            $this->imagen2_path = $grow->imagen2;
            $this->descuento = $grow->descuento;

            if($grow->url!==null){
                $this->url = $grow->url;
            }
            if($grow->cod_desc){
                $this->linkDeRastreo = 'https://doconlineargentina.com/turnero/login/'.$grow->cod_desc;
                $this->generarCodigoQR();
            }
        } else {
            $this->fe_ingreso = date('Y-m-d');
        }
    }

    public function render(){
        $provincias = Provincia::orderBy('Provincia', 'ASC')->get();
        return view('livewire.grows.grow-edit', [
            'provincias' => $provincias,
        ]);
    }



    public function getPacientes(){
        $pacientesDelGrow = TurnoPaciente::whereYear('created_at', $this->anioActual)
        ->whereMonth('created_at', $this->mesActual)
        ->where('grow',$this->growId)
        ->select('id', 'dni', 'grow', 'nombre')
        ->get();

        $pacientesMes_ = 0;
        $pagaronMes_ = 0;


        foreach ($pacientesDelGrow as &$paciente) {
            $pacientesMes_ = $pacientesMes_ + 1;
            $paciente['pago'] = 'No';

            $pac = Paciente::where('dni', $paciente['dni'])->first();
            $añoActual = $this->anioActual;
            $añoAnterior = $añoActual - 1;

            //dd($paciente['id']);
            $pago = Pago::where('id_paciente', $paciente['id'])
            ->latest('created_at')
            ->first();

            $pagoVerificado = false;

            if($pago && $pago->verificado == 1){
                $pagoVerificado = true;
            };

            if ($pac !== null){
                if ($pac->pagado2023 == 1 || $pac->pagado2024 == 1 || $pagoVerificado == true) {
                    $paciente['pago'] = 'Si';
                    $pagaronMes_ = $pagaronMes_ + 1;
                } else {
                    $paciente['pago'] = 'No';
                }
            } else if($pago){
                if ($pago->verificado == 1) {
                    $paciente['pago'] = 'Si';
                    $pagaronMes_ = $pagaronMes_ + 1;
                } else {
                    $paciente['pago'] = 'No';
                }
            } else {
                $paciente['pago'] = 'No';
            }
        }

        $this->pacientesMes = $pacientesMes_;
        $this->pagaronMes = $pagaronMes_;
        $pacientesDelGrow = $pacientesDelGrow->toArray();

        return $pacientesDelGrow;
    }

    public function update(){
        $this->validate();
        $dataGrow = [
            'nombre' => $this->nombre,
            'cbu' => $this->cbu,
            'alias' => $this->alias,
            'titular' => $this->titular,
            'mail' => $this->mail,
            'instagram' => $this->instagram,
            'celular' => $this->celular,
            'idprovincia' => $this->idprovincia,
            'localidad' => $this->localidad,
            'direccion' => $this->direccion,
            'cp' => $this->cp,
            'cod_desc' => $this->cod_desc,
            'fe_ingreso' => $this->fe_ingreso,
            'observ' => $this->observ,
            'activo' => $this->activo,
            'imagen1' => $this->imagen1_path,
            'imagen2' => $this->imagen2_path,
            'url'=> $this->url,
            'descuento' => $this->descuento
        ];

        if($this->growId){
            Grow::find($this->growId)->update($dataGrow);
        } else {
            $this->growId = Grow::create($dataGrow)->idgrow;
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Grow se guardó con éxito"]);

    }

    public function eliminar(){
        Grow::find($this->growId)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el Grow"]);
        return redirect(route('grows'));
    }

    public function updatedImagen1(){
        $this->_actualizarImagen1();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se subió la Imagen 1"]);
    }

    private function _actualizarImagen1(){
        $ext = "." . $this->imagen1->getClientOriginalExtension();
        $fileName = 'grow_'.date_format(Carbon::now(),'Y-m-d_hiu') . $ext;
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $this->imagen1->storeAs('assets/img/uploads', $fileName);
        rename($storagePath . $fileName, $path . $fileName);

        $this->imagen1_path = $fileName;
        if($this->growId){ //Si está editando, actualiza el registro directamente
            Grow::find($this->growId)->update(['imagen1' => $this->imagen1_path]);
        }
    }

    public function eliminarImagen1(){
        $path = public_path('img/uploads/');
        if(file_exists($path . $this->imagen1_path)) unlink($path . $this->imagen1_path);
        $this->imagen1_path = '';
        if($this->growId){
            Grow::find($this->growId)->update(['imagen1' => '']);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó la Imagen 1"]);
    }

    public function updatedImagen2(){
        $this->_actualizarImagen2();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se subió la Imagen 1"]);
    }

    private function _actualizarImagen2(){
        $ext = "." . $this->imagen2->getClientOriginalExtension();
        $fileName = 'grow_'.date_format(Carbon::now(),'Y-m-d_hiu') . $ext;
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $this->imagen2->storeAs('assets/img/uploads', $fileName);
        rename($storagePath . $fileName, $path . $fileName);

        $this->imagen2_path = $fileName;
        if($this->growId){ //Si está editando, actualiza el registro directamente
            Grow::find($this->growId)->update(['imagen2' => $this->imagen2_path]);
        }
    }

    public function eliminarImagen2(){
        $path = public_path('img/uploads/');
        if(file_exists($path . $this->imagen2_path)) unlink($path . $this->imagen2_path);
        $this->imagen2_path = '';
        if($this->growId){
            Grow::find($this->growId)->update(['imagen2' => '']);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó la Imagen 1"]);
    }
}
