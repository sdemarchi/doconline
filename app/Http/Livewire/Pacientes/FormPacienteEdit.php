<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use Carbon\Carbon;

use App\Models\Paciente;
use App\Models\PacientePatologia;
use App\Models\Provincia;
use App\Models\Dolencia;
use App\Models\Beneficio;
use App\Models\Justificacion;
use App\Models\Diagnostico;
use App\Models\Tratamiento;
use App\Models\Producto;
use App\Models\ModoContacto;
use App\Models\Pago;
use App\Models\TurnoPaciente;
use App\Models\Turno;
use App\Models\Grow;

use Illuminate\Support\Facades\DB;


class FormPacienteEdit extends Component
{
    use WithFileUploads;

    public $pacienteId, $patologias, $patologiaAgregar;
    public $_turno = ['hola'];
    public $turnoPaciente;
    public $pago;
    public $cupon = 'No uso cupon';
    public $paginaSeleccionada = 1;
    public $pestPacClass = 'ficha-pestaña-select';
    public $pestMedClass = 'ficha-pestaña-button';
    public $pestPatClass  = 'ficha-pestaña-button';
    public $pestTutorClass = 'ficha-pestaña-button';
    public $pestDefClass = 'ficha-pestaña-button';
    public $pago_verificado;
    public $pago_utilizado;
    public $test;

    public $pagado, $estado, $fe_carga, $fe_aprobacion, $email, $nom_ape, $dni, $fe_nacim, $cod_vincu,
            $edad, $domicilio, $localidad, $idprovincia, $cp, $ocupacion, $celular, $osocial,
            $comentario, $foto_firma, $foto_firma_img, $firma, $aclaracion, $arritmia, $salud_mental,
            $salud_ment_esp, $alergia, $embarazada, $maneja_maq, $dolores = [], $doloresNombres = [], $patologia, $idcontacto,
            $contacto_otro, $es_menor, $tut_apeynom, $tut_tipo_nro_doc, $tut_fe_nacim,
            $tut_domicilio, $tut_localidad, $tut_idprovincia, $tut_cp, $tut_vinculo, $tut_tel_part,
            $tut_tel_cel, $tut_mail, $tut_osocial, $tut_reg_fam,
            $res_historia, $beneficios, $justificacion, $diagnostico, $tratamiento, $cant_plantas,
            $frecuencia, $dosis, $conc_thc, $conc_cbd, $producto = [], $tratam_previo, $producto_indicado,
            $sintomas, $pagado2023,$pagado2024 = false, $instagram;

    protected $rules = [
        'pagado' => '',
        'estado' => 'required',
        'fe_carga' => 'required',
        'fe_aprobacion' => '',
        'email' => 'required',
        'nom_ape' => 'required',
        'dni' => 'required',
        'fe_nacim' => 'required',
        'cod_vincu' => '',
        'edad' => 'required|numeric',
        'domicilio' => 'required',
        'localidad' => 'required',
        'idprovincia' => 'required',
        'cp' => 'required',
        'ocupacion' => '',
        'celular' => 'required',
        'osocial' => '',
        'comentario' => '',
        'arritmia' => '',
        'salud_mental' => '',
        'salud_ment_esp' => 'max:80',
        'alergia' => '',
        'embarazada' => '',
        'maneja_maq' => '',
        'patologia' => '',
        'contacto_otro' => '',
        'es_menor' => '',
        'tut_apeynom' => '',
        'tut_tipo_nro_doc' => '',
        'tut_fe_nacim' => '',
        'tut_domicilio' => '',
        'tut_localidad' => '',
        'tut_idprovincia' => '',
        'tut_cp' => '',
        'tut_vinculo' => '',
        'tut_tel_part' => '',
        'tut_tel_cel' => '',
        'tut_mail' => '',
        'tut_osocial' => '',
        'res_historia' => '',
        'beneficios' => '',
        'justificacion' => '',
        'diagnostico' => '',
        'tratamiento' => '',
        'cant_plantas' => '',
        'frecuencia' => '',
        'dosis' => '',
        'conc_thc' => '',
        'conc_cbd' => '',
        'tratam_previo' => 'max:255',
        'producto_indicado' => 'max:255',
        'sintomas' => 'max:255',
        'pagado2023' => '',
        'pagado2024' => '',
        'instagram' => 'max:150',
        //'patologias.*.item' => '',
        'patologias.*.anio_aprox' => 'numeric|nullable|max:9999|min:1900',
        'patologias.*.medicacion' => 'max:100',
        'patologias.*.prob_trabajo' => '',
        'patologias.*.dolor_intensidad' => 'numeric|nullable|min:0|max:10',
        'patologias.*.partes_cuerpo' => 'max:100',
        'patologias.*.atenua_dolor' => ''

    ];

    public function redireccionarWhatsApp($celular) {
        $numeroFormateado = $this->formatearTelefono($celular);
        $url = 'https://wa.me/' . $numeroFormateado;
        return redirect()->to($url);
    }

    public function formatearTelefono($numero){
        $numeroLimpio = preg_replace('/[^0-9]/', '', $numero);
        if (substr($numeroLimpio, 0, 1) == '0') {
            $numeroLimpio = substr($numeroLimpio, 1);
        }
        if (substr($numeroLimpio, 0, 2) !== '54') {
            $numeroLimpio = '54' . $numeroLimpio;
        }
        $numeroFinal = '+' . $numeroLimpio;

        return $numeroFinal;
    }


    public function cambiarPestana($pest){
        $this->paginaSeleccionada = $pest;
        $this->pestPacClass = 'ficha-pestaña-button';
        $this->pestMedClass = 'ficha-pestaña-button';
        $this->pestPatClass  = 'ficha-pestaña-button';
        $this->pestTutorClass = 'ficha-pestaña-button';
        $this->pestDefClass = 'ficha-pestaña-button';

        if($pest  === 1 ){
            $this->pestPacClass = 'ficha-pestaña-select';
        }
        if($pest  == 2 ){
            $this->pestTutorClass = 'ficha-pestaña-select';
        }
        if($pest  == 3 ){
            $this->pestPatClass = 'ficha-pestaña-select';
        }
        if($pest  == 4 ){
            $this->pestMedClass= 'ficha-pestaña-select';
        }
        if($pest  == 5 ){
            $this->pestDefClass= 'ficha-pestaña-select';
        }

    }

    public function getTurno(){
        $_turno = Turno::where('paciente_id', $this->pacienteId)->first();
    }

    public function getPago(){
        $this->turnoPaciente = TurnoPaciente::where('dni', $this->dni)->first();

        if($this->turnoPaciente){
            $this->pago = Pago::where('id_paciente', $this->turnoPaciente->id)
            ->latest('created_at')
            ->first(['*', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as fecha")]);


            if($this->pago){
                $this->pago_verificado = $this->pago->verificado;
                $this->pago_utilizado = $this->pago->utilizado;
                if($this->pago->id_grow){
                    $this->cupon = Grow::find($this->pago->id_grow)->cod_desc;
                }
            }
        }
    }

    public function pagoVerificadoSwitch(){
        if($this->pago){
            $this->pago_verificado = !$this->pago_verificado;
            $pago_ = Pago::find($this->pago->id);
            if(!$this->pago_verificado){
                $this->pago_verificado = 1;
                $pago_->verificado = $this->pago_verificado;
                $pago_->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Pago verificado"]);

            }else{
                $this->pago_verificado = 0;
                $pago_->verificado = $this->pago_verificado;
                $pago_->save();


                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambios guardados"]);

            }
        }
    }

    public function pagoUtilizadoSwitch(){
        if($this->pago){
            $pago_ = Pago::find($this->pago->id);
            if($this->pago_utilizado === 0){
                $this->pago_utilizado = 1;
                $pago_->utilizado = $this->pago_utilizado;
                $pago_->save();
            }else{
                $this->pago_utilizado = 0;
                $pago_->utilizado = $this->pago_utilizado;
                $pago_->save();
            }

            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Cambios guardados"]);
        }
    }


    public function getCupon($paciente){
        if ($paciente) {
            $paciente_turnero = $paciente->paciente_turnero;
            if ($paciente_turnero->isNotEmpty()) {
                $paciente_id = $paciente_turnero[0]->id;
                if ($paciente_id) {
                    $_turno_paciente = Turno::where('paciente_id', $paciente_id)->first();
                    if ($_turno_paciente !== null && $_turno_paciente->cupon !== null) {
                        return $_turno_paciente->cupon;
                    } else {
                        return 'El paciente no usó cupón';
                    }
                } else {
                    return 'El paciente no usó cupón';
                }
            }
        }

        return 'El paciente no usó cupón';
    }

    public function mount(){
        if($this->pacienteId){
            $paciente = Paciente::where('idpaciente', $this->pacienteId)->first();
            $this->test ='';
            $this->cupon = $this->getCupon($paciente);
            $this->pagado = $paciente->pagado;
            $this->estado = $paciente->estado;
            $this->fe_carga = $paciente->fe_carga;
            $this->fe_aprobacion = $paciente->fe_aprobacion;
            $this->email = $paciente->email;
            $this->nom_ape = $paciente->nom_ape;
            $this->dni = $paciente->dni;
            $this->fe_nacim = $paciente->fe_nacim;
            $this->cod_vincu = $paciente->cod_vincu;
            $this->edad = $paciente->edad;
            $this->domicilio = $paciente->domicilio;
            $this->localidad = $paciente->localidad;
            $this->idprovincia = $paciente->idprovincia;
            $this->cp = $paciente->cp;
            $this->ocupacion = $paciente->ocupacion;
            $this->celular = $paciente->celular;
            $this->osocial = $paciente->osocial;
            $this->comentario = $paciente->comentario;
            $this->dolores = explode(',',$paciente->dolores);
            $this->foto_firma_img = $paciente->foto_firma;
            $this->firma = $paciente->firma_v2;
            $this->aclaracion = $paciente->aclaracion_v2;
            $this->arritmia = $paciente->arritmia;
            $this->salud_mental = $paciente->salud_mental;
            $this->salud_ment_esp = $paciente->salud_ment_esp;
            $this->alergia = $paciente->alergia;
            $this->embarazada = $paciente->embarazada;
            $this->maneja_maq = $paciente->maneja_maq;
            $this->patologia = $paciente->patologia;
            $this->idcontacto = $paciente->idcontacto;
            $this->contacto_otro = $paciente->contacto_otro;
            $this->es_menor = $paciente->es_menor;

            $this->tut_apeynom = $paciente->tut_apeynom;
            $this->tut_tipo_nro_doc = $paciente->tut_tipo_nro_doc;
            $this->tut_fe_nacim = $paciente->tut_fe_nacim;
            $this->tut_domicilio = $paciente->tut_domicilio;
            $this->tut_localidad = $paciente->tut_localidad;
            $this->tut_idprovincia = $paciente->tut_idprovincia;
            $this->tut_cp = $paciente->tut_cp;
            $this->tut_vinculo = $paciente->tut_vinculo;
            $this->tut_tel_part = $paciente->tut_tel_part;
            $this->tut_tel_cel = $paciente->tut_tel_cel;
            $this->tut_mail = $paciente->tut_mail;
            $this->tut_osocial = $paciente->tut_osocial;
            $this->tut_reg_fam = $paciente->tut_reg_fam;
            $this->res_historia = $paciente->res_historia;
            $this->beneficios = $paciente->beneficios;
            $this->justificacion = $paciente->justificacion;
            $this->diagnostico = $paciente->diagnostico;
            $this->tratamiento = $paciente->tratamiento;
            $this->cant_plantas = $paciente->cant_plantas;
            $this->frecuencia = $paciente->frecuencia;
            $this->dosis = $paciente->dosis;
            $this->conc_thc = $paciente->conc_thc;
            $this->conc_cbd = $paciente->conc_cbd;
            $this->producto = explode(',',$paciente->producto);
            $this->tratam_previo = $paciente->tratam_previo;
            $this->producto_indicado = $paciente->producto_indicado;
            $this->sintomas = $paciente->sintomas;
            $this->pagado2023 = $paciente->pagado2023;
            $this->pagado2024 = $paciente->pagado2024;
            $this->instagram = $paciente->instagram;
            //Autocompletado de campos incompletos en la edición
            if($this->diagnostico == '') $this->diagnostico = $this->_generarDoloresNombres();
            if(!$this->res_historia){
                    $this->res_historia = $this->generarHistoria();
            }
            if(!$this->beneficios){
                $this->beneficios = "Mejorar los síntomas citados y disminuir o evitar el uso de fármacos con sus respectivos efectos adversos";
            }
            if(!$this->justificacion){
                $this->justificacion = "Mejorar los síntomas citados y disminuir o evitar el uso de fármacos con sus respectivos efectos adversos";
            }
            if(!$this->producto_indicado){
                $this->producto_indicado = "Hasta 30 mg de CBD al día según requerimiento. Vía oral o inhalada. THC misma dosis vía tópica. Durante tres años.";
            }
            if(!$this->cant_plantas){
                $this->cant_plantas = "9";
            }
            if(!$this->frecuencia){
                $this->frecuencia = "Trimestral";
            }
            if(!$this->dosis){
                $this->dosis = "Hasta 20 gotas al día según requerimiento";
            }
            if(!$this->conc_thc){
                $this->conc_thc = "1.00";
            }
            if(!$this->conc_cbd){
                $this->conc_cbd = "5.00";
            }
            if(!$this->tratam_previo){
                $this->tratam_previo = "No medicado";
            }
            $this->producto = ['1','2'];
            if($this->diagnostico == '') $this->diagnostico = $this->_generarDoloresNombres();

        } else {  //Nuevo paciente
            $this->fe_carga = date('Y-m-d');
            $this->dolores = [];
            $this->es_menor = 0;
            $this->tut_reg_fam = 0;
            $this->arritmia = 0;
            $this->salud_mental = 0;
            $this->alergia = 0;
            $this->embarazada = 0;
            $this->maneja_maq = 0;
            $this->res_historia = "Paciente de ___ años. Que trabaja como ___. Con antecedentes de __ desde el año __. Dicho problema de salud "
                                    . "está vinculado a ___. No medicado. Consulta por ___. Solicita tratamiento alternativo como lo es el "
                                    . "cannabis medicinal. "
                                    . "Al día de la fecha no se considera necesario la interconsulta con un especialista.";

            $this->beneficios = "Mejorar los síntomas citados y disminuir o evitar el uso de fármacos con sus respectivos efectos adversos";
            $this->justificacion = "Mejorar los síntomas citados y disminuir o evitar el uso de fármacos con sus respectivos efectos adversos";
            $this->producto_indicado = "Hasta 30 mg de CBD al día según requerimiento. Vía oral o inhalada. THC misma dosis vía tópica. Durante tres años.";
            $this->cant_plantas = "9";
            $this->frecuencia = "Trimestral";
            $this->dosis = "Hasta 20 gotas al día según requerimiento";
            $this->producto = ['1','2'];
            $this->conc_thc = "1.00";
            $this->conc_cbd = "5.00";
            $this->tratam_previo = "No medicado";

        }

    }

    public function generarHistoria(){
        $patologiasText = '';
        $desdeText = '';
        $vinculadoText = 'factores personales';
        $factoresLaborales  = false;
        $patologiasCount = 0;

        if($this->patologias !== null){
            $patologiasCount = count($this->patologias);
        }

        if($patologiasCount > 1){
            $desdeText = 'Desde los años ';

            foreach($this->patologias as $key => $patologia){

                if($factoresLaborales === false){
                    $factoresLaborales = $patologia->prob_trabajo == 1;
                }

                if($key + 2 == count($this->patologias)){
                    $patologiasText = $patologiasText . $patologia->patologia->dolencia . ' y';
                    $desdeText =  $desdeText . $patologia->anio_aprox. ' y ';

                }else if($key + 2 > count($this->patologias)){
                    $patologiasText = $patologiasText . $patologia->patologia->dolencia . '. ';
                    $desdeText =  $desdeText . $patologia->anio_aprox;

                }else if($key + 2 < count($this->patologias)){
                    $patologiasText = $patologiasText . $patologia->patologia->dolencia . ', ';
                    $desdeText =  $desdeText . $patologia->anio_aprox  . ', ';
                }
            }

            $desdeText = $desdeText . ' respectivamente.';

        }else if($patologiasCount == 1){
            $desdeText = 'desde el año ';

            foreach($this->patologias as $patologia){
                $patologiasText = $patologiasText . $patologia->patologia->dolencia;
                $desdeText = $desdeText . $patologia->anio_aprox;
                $desdeText = $desdeText . '. ';
            }
        }else {
            $patologiasText = ' ____.';
            $desdeText = 'Desde el año ____.';
        }


        if($factoresLaborales){
            $vinculadoText = $vinculadoText . ' y/o laborales.';
        }

        $this->res_historia = "Paciente de $this->edad años. Que trabaja como $this->ocupacion. Con antecedentes de$patologiasText $desdeText Dicho problema de salud "
        . "está vinculado a $vinculadoText. No medicado. Consulta por ___. Solicita tratamiento alternativo como lo es el "
        . "cannabis medicinal. "
        . "Al día de la fecha no se considera necesario la interconsulta con un especialista.";
    }

    private function _generarDoloresNombres(){
        foreach($this->dolores as $dol){
            if($dol){
                $dolencia = Dolencia::find($dol[0]);
                $this->doloresNombres[] = $dolencia->dolencia;
            }
        }

        return implode(',',$this->doloresNombres);
    }

    public function render(){
        $this -> getPago();
        $provincias = Provincia::orderBy('Provincia', 'ASC')->get();
        $dolencias = Dolencia::get();
        $modos_contacto = ModoContacto::get();
        $beneficiosList = Beneficio::get();
        $justificaciones = Justificacion::get();
        $diagnosticos = Diagnostico::get();
        $tratamientos = Tratamiento::get();
        $productos = Producto::get();
        $this->dispatchBrowserEvent('refresh');

        if($this->pacienteId) $this->patologias = PacientePatologia::where('idpaciente',$this->pacienteId)->get();
        return view('livewire.pacientes.form-paciente-edit', compact('provincias', 'dolencias', 'modos_contacto','beneficiosList','justificaciones','diagnosticos','tratamientos','productos'));
    }

    public function refresh(){
        //$this->dispatchBrowserEvent('refresh');
    }

    public function setFirma($firma){
        $this->firma = $firma;
    }

    public function setAclaracion($aclaracion){
        $this->aclaracion = $aclaracion;
    }

    public function guardarFirma($firma){
        $this->firma = $firma;
        Paciente::find($this->pacienteId)->update(['firma_v2' => $this->firma]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardó la firma"]);
    }

    public function guardarAclaracion($aclaracion){
        $this->aclaracion = $aclaracion;
        Paciente::find($this->pacienteId)->update(['aclaracion_v2' => $this->aclaracion]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardó la aclaracion"]);
    }

    public function update(){
        $this->validate();
        $dataPaciente = [
            'pagado' => $this->pagado,
            'estado' => $this->estado,
            'fe_carga' => $this->fe_carga,
            'fe_aprobacion' => $this->fe_aprobacion,
            'email' =>  $this->email,
            'nom_ape' =>  $this->nom_ape,
            'dni' =>  $this->dni,
            'fe_nacim' =>  $this->fe_nacim,
            'cod_vincu' =>  $this->cod_vincu,
            'edad' =>  $this->edad,
            'domicilio' =>  $this->domicilio,
            'localidad' =>  $this->localidad,
            'idprovincia' =>  $this->idprovincia,
            'cp' =>  $this->cp,
            'ocupacion' =>  $this->ocupacion,
            'celular' =>  $this->celular,
            'osocial' =>  $this->osocial,
            'comentario' =>  $this->comentario,
            'dolores' => implode(',',$this->dolores),
            'foto_firma' => $this->foto_firma_img,
            'arritmia' => $this->arritmia,
            'salud_mental' => $this->salud_mental,
            'salud_ment_esp' => $this->salud_ment_esp,
            'alergia' => $this->alergia,
            'embarazada' => $this->embarazada,
            'maneja_maq' => $this->maneja_maq,

            'patologia' =>  $this->patologia,
            'idcontacto' => $this->idcontacto,
            'contacto_otro' => $this->contacto_otro,
            'es_menor' =>  $this->es_menor,
            'tut_apeynom' =>  $this->tut_apeynom,
            'tut_tipo_nro_doc' =>  $this->tut_tipo_nro_doc,
            'tut_fe_nacim' =>  $this->tut_fe_nacim,
            'tut_domicilio' =>  $this->tut_domicilio,
            'tut_localidad' =>  $this->tut_localidad,
            'tut_idprovincia' =>  $this->tut_idprovincia,
            'tut_cp' =>  $this->tut_cp,
            'tut_vinculo' =>  $this->tut_vinculo,
            'tut_tel_part' =>  $this->tut_tel_part,
            'tut_tel_cel' =>  $this->tut_tel_cel,
            'tut_mail' =>  $this->tut_mail,
            'tut_osocial' =>  $this->tut_osocial,
            'tut_reg_fam' =>  $this->tut_reg_fam,
            'res_historia' =>  $this->res_historia,
            'beneficios' => $this->beneficios,
            'justificacion' => $this->justificacion,
            'diagnostico' => $this->diagnostico,
            'tratamiento' => $this->tratamiento,
            'cant_plantas' => $this->cant_plantas,
            'frecuencia' => $this->frecuencia,
            'dosis' => $this->dosis,
            'conc_thc' => $this->conc_thc,
            'conc_cbd' => $this->conc_cbd,
            'producto' => implode(',',$this->producto),
            'tratam_previo' => $this->tratam_previo,
            'producto_indicado' => $this->producto_indicado,
            'sintomas' => $this->sintomas,
            'pagado2023' => $this->pagado2023,
            'pagado2024' => $this->pagado2024,
            'instagram' => $this->instagram,
        ];

        if($this->pacienteId){
            Paciente::find($this->pacienteId)->update($dataPaciente);
        } else {
            $dataPaciente['firma_v2'] = $this->firma;
            $dataPaciente['aclaracion_v2'] = $this->aclaracion;
            $this->pacienteId = Paciente::create($dataPaciente)->idpaciente;
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "El Paciente se modificó con éxito"]);

    }

    public function updatedFotoFirma(){
        $this->_actualizarFotoFirma();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se subió la foto"]);
    }

    private function _actualizarFotoFirma(){
        $fileName = 'firma_'.date_format(Carbon::now(),'Y-m-d_hiu') .'.png';
        $storagePath = storage_path('app/assets/img/uploads/');
        $path = public_path('img/uploads/');

        $this->foto_firma->storeAs('assets/img/uploads', $fileName);
        rename($storagePath . $fileName, $path . $fileName);

        $this->foto_firma_img = $fileName;

        if($this->pacienteId){ //Si está editando, actualiza el registro directamente
            Paciente::find($this->pacienteId)->update(['foto_firma' => $this->foto_firma_img]);
        }
    }

    public function eliminarFotoFirma(){
        $path = public_path('img/uploads/');
        if(file_exists($path . $this->foto_firma_img)) unlink($path . $this->foto_firma_img);
        $this->foto_firma_img = '';
        if($this->pacienteId){
            Paciente::find($this->pacienteId)->update(['foto_firma' => '']);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó la foto"]);
    }

    public function switchDolencia($id,$dolencia){
        $val = strval($id);
        $index = array_search($val, $this->dolores);
        if($index === false){
            $this->dolores[] = $val;
        } else {
            unset($this->dolores[$index]);
        }

        $indexNombre = array_search($dolencia, $this->doloresNombres);
        if($index === false){
            $this->doloresNombres[] = $dolencia;
        } else {
            unset($this->doloresNombres[$indexNombre]);
        }
        $this->diagnostico = implode(',',$this->doloresNombres);
    }

    public function switchProducto($value){
        $val = strval($value);
        $index = array_search($val, $this->producto);
        if($index == false){
            $this->producto[] = $val;
        } else {
            unset($this->producto[$index]);
        }
    }

    public function switchBeneficio($id){
        $string = Beneficio::where('idbeneficio',$id)->first()->beneficio;
        $pos = strpos($this->beneficios, $string);
        if($pos === false){
            if(trim($this->beneficios == "","\n")){
                $this->beneficios = $string;
            } else {
                $this->beneficios = $this->beneficios . "\n" . $string;
            }
        } else {
            $this->beneficios = trim(str_replace($string, "", $this->beneficios),"\n");
        }
    }

    public function switchJustificacion($id){
        $string = Justificacion::where('idjustifica',$id)->first()->justificacion;
        $pos = strpos($this->justificacion, $string);
        if($pos === false){
            if(trim($this->justificacion == "","\n")){
                $this->justificacion = $string;
            } else {
                $this->justificacion = $this->justificacion . "\n" . $string;
            }
        } else {
            $this->justificacion = trim(str_replace($string, "", $this->justificacion),"\n");
        }
    }

    public function switchDiagnostico($id){
        $string = Diagnostico::where('iddiagnostico',$id)->first()->diagnostico;
        $pos = strpos($this->diagnostico, $string);
        if($pos === false){
            if(trim($this->diagnostico == "","\n")){
                $this->diagnostico = $string;
            } else {
                $this->diagnostico = $this->diagnostico . ", " . $string;
            }

        } else {
            $this->diagnostico = trim(str_replace(", " . $string, "", $this->diagnostico),"\n");
            $this->diagnostico = trim(str_replace("," . $string, "", $this->diagnostico),"\n");
            $this->diagnostico = trim(str_replace($string . ", ", "", $this->diagnostico),"\n");
            $this->diagnostico = trim(str_replace($string . ",", "", $this->diagnostico),"\n");
            $this->diagnostico = trim(str_replace($string, "", $this->diagnostico),"\n");
        }
    }

    public function switchTratamiento($id){
        $string = Tratamiento::where('idtrata',$id)->first()->tratamiento;
        $pos = strpos($this->tratamiento, $string);
        if($pos === false){
            if(trim($this->tratamiento == "","\n")){
                $this->tratamiento = $string;
            } else {
                $this->tratamiento = $this->tratamiento . "\n" . $string;
            }
        } else {
            $this->tratamiento = trim(str_replace($string, "", $this->tratamiento),"\n");
        }
    }

    public function agregarPatologia(){
        $this->validate(['patologiaAgregar' => 'required']);
        PacientePatologia::create([
            'item' => $this->patologiaAgregar,
            'dni' => $this->dni,
            'idpaciente' => $this->pacienteId,
        ]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se agregó la Patología"]);
    }

    public function quitarPatologia($id){
        PacientePatologia::find($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se quitó la Patología"]);
    }

    public function guardarPatologia($id){
        $this->validateOnly('patologias.*.anio_aprox');
        $this->validateOnly('patologias.*.medicacion');
        $this->validateOnly('patologias.*.dolor_intensidad');
        $this->validateOnly('patologias.*.partes_cuerpo');
        $this->patologias[$id]->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se guardaron los cambios"]);
    }

    public function eliminar(){
        $paciente = Paciente::find($this->pacienteId)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se eliminó el registro del Paciente"]);
        return redirect(route('pacientes'));
    }

    public function actualizarFechaEdad(){
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => "Se actualizó la Fecha de carga y Edad del Paciente"]);
        $this->fe_carga = Carbon::now()->format('Y-m-d');
        $this->edad = $this->_getEdad($this->fe_nacim);
    }

    private function _getEdad($nacimiento){
        $fecha_nac = Carbon::createFromFormat('Y-m-d',"$nacimiento");
        $ahora =  Carbon::now();
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }
}
