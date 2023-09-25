<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Dolencia;

class Paciente extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idpaciente';
    protected $appends = ['ocupacion_id'];

    protected $fillable = ['cod_descto','email','nom_ape','dni','fe_nacim','edad','domicilio','localidad','idprovincia','cp','ocupacion',
                            'celular','osocial','patologia','dolores','cod_vincu','foto_firma','comentario','arritmia',
                            'salud_mental','idcontacto','contacto_otro','salud_ment_esp','alergia','embarazada','maneja_maq',
                            'fe_carga','fe_aprobacion','es_menor','tut_apeynom','tut_tipo_nro_doc','tut_fe_nacim','tut_domicilio','tut_localidad',
                            'tut_idprovincia','tut_cp','tut_vinculo','tut_tel_part','tut_tel_cel','tut_mail','tut_osocial','tut_reg_fam',
                            'res_historia','cant_plantas','dosis','conc_thc','conc_cbd','frecuencia','beneficios','diagnostico',
                            'justificacion','tratamiento','producto','pagado','estado','firma','aclaracion','diagnos_items','beneficios_items',
                            'justifica_items','tratam_items','tratam_previo','producto_indicado','firma_v2','aclaracion_v2','sintomas',
                            'pagado2023','instagram','version'];

    /*public function getFeNacimFormatAttribute()
    {
        return date_format(date_create($this->fe_nacim),"d/m/Y");
    }*/

    public function getOcupacionIdAttribute(){
        $ocup = Ocupacion::where('ocupacion',$this->ocupacion)->first();
        if($ocup){
            return $ocup->id;
        } else {
            return 0;
        }
    }

    public function provincia(){
        return $this->belongsTo(Provincia::class, 'idprovincia');
    }

    public function tut_provincia(){
        return $this->belongsTo(Provincia::class, 'tut_idprovincia');
    }

    public function modo_contacto(){
        return $this->belongsTo(ModoContacto::class, 'idcontacto');
    }

    public function getEstado(){
        switch($this->estado){
            case 'P':
                return 'Por Realizar';
                break;
            case 'H':
                return 'Hecho';
                break;
            case '3':
                return 'Hecho 2023';
                break;
            case 'E':
                return 'Espera';
            break;
            case '2':
                return 'En espera 2';
                break;
            case 'A':
                return 'Aprobado';
                break;
            case 'R':
                return 'Rechazado';
                break;
            case 'N':
                return 'No responde';
                break;
            default:
                return 'No Definido';
                break;
        }
    }

    public function getDolencias(){
        $dolencias = explode(',', $this->dolores);
        $str = "";
        foreach($dolencias as $d){
            $dol = Dolencia::where('iddolencia',$d)->first();
            if($dol){
                $str = $str . $dol->dolencia . "<br/>";
            }
        }
        return $str;
    }

}
