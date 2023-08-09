<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

use App\Mail\FormularioCompleto;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
use App\Models\Ocupacion;
use App\Models\Turno;
use App\Models\Cupon;

use App\Models\TurnoPaciente;

class FormPacienteHome extends Component
{
    use WithFileUploads;

    public  $cod_descto, $fe_carga, $email, $nom_ape, $dni, $fe_nacim, $dia_nac, $mes_nac, $anio_nac, $cod_vincu,
            $edad, $domicilio, $localidad, $idprovincia, $cp, $ocupacion, $ocupacion_otra, $celular, $osocial,
            $comentario, $firma, $aclaracion, $arritmia, $salud_mental, $salud_ment_esp ,$alergia, 
            $embarazada, $maneja_maq, $patologia, $idcontacto, 
            $contacto_otro, $es_menor, $tut_apeynom, $tut_tipo_nro_doc, $tut_fe_nacim, $dia_nac_tut, $mes_nac_tut, 
            $anio_nac_tut, $tut_domicilio, $tut_localidad, $tut_idprovincia, $tut_cp, $tut_vinculo, $tut_tel_part,
            $tut_tel_cel, $tut_mail, $tut_osocial, $tut_reg_fam;

    public  $agregar_patologia, $editar_patologia, $patologias = [], $patArrayId, $pat_id, $pat_anio, $pat_medicacion, 
            $pat_probTrabajo = 0, $pat_dolorInt = 0, $pat_partesCuerpo, $pat_atenuaDolor = 0;

    protected $rules = [
        'cod_descto' => 'max:30',
        'fe_carga' => 'required',
        'email' => 'required|max:130',
        'nom_ape' => 'required|max:255',
        'dni' => 'required|max:10',
        //'fe_nacim' => 'required',
        'dia_nac' => 'required',
        'mes_nac' => 'required',
        'anio_nac' => 'required',
        'cod_vincu' => 'max:100',
        'edad' => 'required|numeric',
        'domicilio' => 'required|max:255',
        'localidad' => 'required|max:255',
        'idprovincia' => 'required',
        'cp' => 'required|max:20',
        'ocupacion' => 'max:100',
        'celular' => 'required|numeric|digits_between:9,12',
        'osocial' => 'max:255',
        'comentario' => 'max:500',
        'arritmia' => '', 
        'salud_mental' => '',
        'salud_ment_esp' => 'max:80',
        'alergia' => '', 
        'embarazada' => '', 
        'maneja_maq' => '',
        'patologia' => '',
        'contacto_otro' => 'max:100',
        'es_menor' => '',
        'tut_apeynom' => 'max:255',
        'tut_tipo_nro_doc' => 'max:40',
        //'tut_fe_nacim' => '',
        'dia_nac_tut' => '',
        'mes_nac_tut' => '',
        'anio_nac_tut' => '',
        'tut_domicilio' => 'max:255',
        'tut_localidad' => 'max:255',
        'tut_idprovincia' => '',
        'tut_cp' => 'max:20',
        'tut_vinculo' => 'max:100',
        'tut_tel_part' => 'max:20',
        'tut_tel_cel' => 'max:20',
        'tut_mail' => 'max:150',
        'tut_osocial' => 'max:255',
        'tut_reg_fam' => ''
    ];

    protected $patRules = [
        'pat_id' => 'required', 
        'pat_anio' => 'required|numeric|nullable|max:9999', 
        'pat_medicacion' => 'max:100', 
        'pat_probTrabajo' => '', 
        'pat_dolorInt' => '', 
        'pat_partesCuerpo' => 'max:100',
        'pat_atenuaDolor' => 'required',
    ];

    public function mount(){
        if(session('pacienteId')){
            $pacienteTurno = TurnoPaciente::find(session('pacienteId'));
            $this->dni = $pacienteTurno->dni;
            $this->fe_nacim = $pacienteTurno->fecha_nac;
            $this->nom_ape = $pacienteTurno->nombre;
            $this->celular = $pacienteTurno->telefono;
            $this->domicilio = $pacienteTurno->direccion;
            $this->email = $pacienteTurno->email;
            //Busca Cupón
            $turno = Turno::where('paciente_id',$pacienteTurno->id)
                    ->orderBy('fecha','DESC')->first();
            if($turno){
                if($turno->id_cupon){
                    $cupon = Cupon::find($turno->id_cupon);
                    $this->cod_descto = $cupon->codigo;
                }
            }
        }

        $this->fe_carga = date('Y-m-d');
        $this->es_menor = 0; 
        $this->tut_reg_fam = 0;
        $this->arritmia = 0; 
        $this->salud_mental = 0;
        $this->alergia = 0; 
        $this->embarazada = 0;
        $this->maneja_maq = 0;
        
    }

    public function render()
    {
        $provincias = Provincia::orderBy('Provincia', 'ASC')->get();
        $ocupaciones = Ocupacion::get();
        $modos_contacto = ModoContacto::get();
        $dolencias = Dolencia::get();
        $this->dispatchBrowserEvent('resetFirmas');  
        return view('livewire.front.form-paciente-home', compact('modos_contacto','provincias','dolencias','ocupaciones'));
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
    
    public function update(){
        $this->validate();
        $resp = $this->_checkUniques();
        if($resp) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $resp]);
            return;
        }
        $fechaNac = $this->_generarFecha($this->dia_nac, $this->mes_nac, $this->anio_nac);
        $fechaNacTutor = null;
        if($this->es_menor){
            $this->validate([
                'tut_apeynom' => 'required|max:255',
                'tut_tipo_nro_doc' => 'required|max:40',
                //'tut_fe_nacim' => '',
                'dia_nac_tut' => 'required',
                'mes_nac_tut' => 'required',
                'anio_nac_tut' => 'required',
                'tut_domicilio' => 'max:255',
                'tut_localidad' => 'required|max:255',
                'tut_idprovincia' => 'required',
                'tut_cp' => 'required|max:20',
                'tut_vinculo' => 'required|max:100',
                'tut_tel_part' => 'max:20',
                'tut_tel_cel' => 'required|digits_between:9,12',
                'tut_mail' => 'required|max:150',
                'tut_osocial' => 'required|max:255',
            ]);
            $fechaNacTutor = $this->_generarFecha($this->dia_nac_tut, $this->mes_nac_tut, $this->anio_nac_tut);
        }
        $dataPaciente = [
            'cod_descto' => $this->cod_descto,
            'fe_carga' => $this->fe_carga,
            'email' =>  $this->email,
            'nom_ape' =>  $this->nom_ape,
            'dni' =>  $this->dni,
            'fe_nacim' =>  $fechaNac,
            'cod_vincu' =>  $this->cod_vincu,
            'edad' =>  $this->edad,
            'domicilio' =>  $this->domicilio,
            'localidad' =>  $this->localidad,
            'idprovincia' =>  $this->idprovincia,
            'cp' =>  $this->cp,
            'ocupacion' =>  $this->ocupacion == "Otra" ? $this->ocupacion_otra : $this->ocupacion,
            'celular' =>  $this->celular,
            'osocial' =>  $this->osocial,
            'comentario' =>  $this->comentario,
            'firma_v2' => $this->firma,
            'aclaracion_v2' => $this->aclaracion,
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
            'tut_fe_nacim' =>  $fechaNacTutor,
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
            
        ];
            $pacienteId = Paciente::create($dataPaciente)->idpaciente;
            $this->_guardarPatologias($pacienteId);
            $this->_mailFormularioCompleto($pacienteId);
            return redirect()->route('paciente.success');
        
    }

    private function _guardarPatologias($id){
        foreach($this->patologias as $pat){
            PacientePatologia::create([
                'item' => $pat['id'],
                'dni' => $this->dni,
                'idpaciente' => $id,
                'anio_aprox' => $pat['anio'],
                'medicacion' => $pat['medicacion'],
                'prob_trabajo' => $pat['probTrabajo'],
                'dolor_intensidad' => $pat['dolorInt'],
                'partes_cuerpo' => $pat['partesCuerpo'],
                'atenua_dolor' => $pat['atenuaDolor']
            ]);
        }
        
    }

    private function _mailFormularioCompleto($pacienteId){
        $paciente = Paciente::find($pacienteId);
        $mailTo = $paciente->email;
        Mail::to($mailTo)->send(new FormularioCompleto($paciente));
    }

    public function agregarPatologia(){
        $this->agregar_patologia = true;
    }

    public function cancelarAgregarPatologia(){
        $this->pat_id = ''; 
        $this->pat_anio = ''; 
        $this->pat_medicacion = ''; 
        $this->pat_probTrabajo = 0; 
        $this->pat_dolorInt = 0; 
        $this->pat_partesCuerpo = '';
        $this->pat_atenuaDolor = 0; 
        $this->agregar_patologia = false;   
        $this->editar_patologia = false;
    }

    public function guardarPatologia(){
        $this->validate($this->patRules);
        $patAgregar = Dolencia::find($this->pat_id);
        $this->patologias[] = [
            'id' => $this->pat_id,
            'nombre' => $patAgregar->dolencia,
            'anio' => $this->pat_anio,
            'medicacion' => $this->pat_medicacion,
            'probTrabajo' => $this->pat_probTrabajo,
            'dolorInt' => $this->pat_dolorInt,
            'partesCuerpo' => $this->pat_partesCuerpo,
            'atenuaDolor' => $this->pat_atenuaDolor
        ];
        $this->cancelarAgregarPatologia();
    }

    public function quitarPatologia($i){
        unset($this->patologias[$i]);
        $this->patologias = array_values($this->patologias);
    }

    public function editarPatologia($i){
        $this->patArrayId = $i;
        $pat = $this->patologias[$i];
        $this->pat_id = $pat['id'];
        $this->pat_anio = $pat['anio'];
        $this->pat_medicacion = $pat['medicacion'];
        $this->pat_probTrabajo = $pat['probTrabajo'];
        $this->pat_dolorInt = $pat['dolorInt'];
        $this->pat_partesCuerpo = $pat['partesCuerpo'];
        $this->pat_atenuaDolor = $pat['atenuaDolor'];
        $this->agregar_patologia = true;
        $this->editar_patologia = true;
    }

    public function actualizarPatologia(){
        $this->validate($this->patRules);
        $i = $this->patArrayId;
        $patActualizar = Dolencia::find($this->pat_id);
        $this->patologias[$i]['id'] = $this->pat_id;
        $this->patologias[$i]['nombre'] = $patActualizar->dolencia;
        $this->patologias[$i]['anio'] = $this->pat_anio;
        $this->patologias[$i]['medicacion'] = $this->pat_medicacion;
        $this->patologias[$i]['probTrabajo'] = $this->pat_probTrabajo;
        $this->patologias[$i]['dolorInt'] = $this->pat_dolorInt;
        $this->patologias[$i]['partesCuerpo'] = $this->pat_partesCuerpo;
        $this->patologias[$i]['atenuaDolor'] = $this->pat_atenuaDolor;
        $this->cancelarAgregarPatologia();
    }

    private function _generarFecha($dia,$mes,$anio){
        return Carbon::createFromFormat('Y-n-j',"$anio-$mes-$dia");
    }

    private function _checkUniques(){
        $result = Paciente::where('dni',$this->dni)->first();
        if($result) return "El número de DNI ingresado ya existe";
        $result = Paciente::where('email',$this->email)->first();
        if($result) return "El E-Mail ingresado ya existe";
        return "";
    }

    
}
