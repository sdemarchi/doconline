<head>
    
    <style>
    body {
        background: url({{ asset("/img/formularios/declaracion.png")}});
        background-size: 21cm;
        color: #000;
    }

    html {
        margin: 0px;
        padding: 0px;
    }
    
    .bloque {
        position: absolute;
        line-height: 17.3px;
        font-family: "Poppins", sans-serif;
        font-size: 11px;
    }

    .bloque1{
        top: 174px;
        left: 150px;
    }

    .bloque2{
        top: 353px;
        left: 150px;
    }

    .bloque3{
        top: 532px;
        left: 150px;
    }

    .bloque4{
        top: 691px;
        left: 459px;
        line-height: 20px;
    }

    .bloque5{
        top: 776px;
        left: 459px;
        line-height: 24px;
    }

    .bloque6{
        top: 898px;
        left: 50px;
        line-height: 16px;
        
    }

    .bloque7{
        top: 1050px;
        left: 80px;
    }
    </style>
    </head>
    <body>
        
        <div class="bloque bloque1">
            <span>{{ $paciente->nom_ape }}</span> <br/>
            <span>DNI {{ $paciente->dni }}</span> <span style="position: fixed; left: 450px"> {{ date_format(date_create($paciente->fe_nacim),"d/m/Y") }}</span> <br/>
            <span> {{ $paciente->domicilio }}</span> <br/>
            <span> {{ $paciente->localidad }}</span><span style="position: fixed; left: 450px"> {{ $paciente->provincia->Provincia }} </span>
            <span style="position: fixed; left: 620px"> {{ $paciente->cp }}</span>  <br/>
            <span style="position: fixed; left: 450px"> {{ $paciente->celular }}</span> <br/>
            <span> {{ $paciente->email }}</span> <br/>
            <span> {{ $paciente->osocial }}</span> <br/>
        </div>
        
        @if($paciente->es_menor)
        <div class="bloque bloque2">
            <span>{{ $paciente->tut_apeynom }}</span> <span style="position: fixed; left: 430px">{{ $paciente->tut_tipo_nro_doc }}</span>
                <span style="position: fixed; left: 620px"> {{ date_format(date_create($paciente->tut_fe_nacim),"d/m/Y") }}</span>  <br/>
            <span style="position: fixed; left: 100px">{{ $paciente->tut_domicilio }}</span><span style="position: fixed; left: 380px">{{ $paciente->tut_localidad }}</span> 
                <span style="position: fixed; left: 510px">{{ $paciente->tut_provincia->Provincia }}</span><span style="position: fixed; left: 620px">{{ $paciente->tut_cp }}</span><br/>
            <span style="position: fixed; left: 300px">{{ $paciente->tut_vinculo }}</span> <br/>
            <span>{{ $paciente->tut_tel_part }}</span> <span style="position: fixed; left: 450px">{{ $paciente->tut_tel_cel }}</span><br/>
            <span>{{ $paciente->tut_mail }}</span> <br/>
            <span>{{ $paciente->tut_osocial }}</span> <br/>
            @if($paciente->tut_reg_fam)
            <span style="position: fixed; left: 285px">x</span> <br/>
            
            @else
            <span style="position: fixed; left: 368px">x</span> <br/>
            
            @endif
        </div>
        @endif
        
        <div class="bloque bloque3">
            <span>{{ $medico->apeynom }}</span> <span style="position: fixed; left: 550px">{{ $medico->tipo_nro_doc }}</span><br/>
            <span>{{ $medico->matricula }}</span> <span style="position: fixed; left: 380px">{{ $medico->especialidad }}</span><br/>
            <span style="position: fixed; left: 205px">{{ $medico->tel_part }}</span> <span style="position: fixed; left: 450px">{{ $medico->tel_cel }}</span><br/>
            <span style="position: fixed; left: 205px">{{ $medico->email }}</span> <br/>
            <span style="position: fixed; left: 185px; padding-right:25px; line-height:16.9px">{{ $paciente->res_historia }}</span> <br/>
        </div>

        <div class="bloque bloque4">
            @if(!$paciente->arritmia)<span>x</span>@else<span style="position: fixed; left: 495px">x</span>@endif<br/>
            @if(!$paciente->salud_mental)<span>x</span>@else<span style="position: fixed; left: 495px">x</span>@endif<br/>
            @if($paciente->salud_mental)<span style="position: fixed; top:557; left: 180px">{{ $paciente->salud_ment_esp }}</span>@endif<br/>
        </div>

        <div class="bloque bloque5">
            @if(!$paciente->alergia)<span>x</span>@else<span style="position: fixed; left: 495px">x</span>@endif<br/>
            @if(!$paciente->embarazada)<span style="position: fixed; top: 802px">x</span>@else<span style="position: fixed; top: 802px; left: 495px">x</span>@endif<br/>
            @if(!$paciente->maneja_maq)<span>x</span>@else<span style="position: fixed; left: 495px">x</span>@endif<br/>
        </div>

        <span class="bloque" style="position: fixed; left: 120px; top: 847px">{{ $paciente->diagnostico }}</span>

        <div class="bloque bloque6">
            <span>{{ $paciente->justificacion }}</span><br/>
            <span>{{ $paciente->tratam_previo }}</span><br/>
            <span>{{ $paciente->producto_indicado }}</span><br/>
        </div>
        
        <div style="position: fixed; left: 40px; top: 960px">
            <img src="{{ asset('/img/uploads/' . $medico->firma) }}" height="60" />
        </div>
        <div style="position: fixed; left: 305px; top: 956px">
            <img src="{{ asset('/img/uploads/' . $medico->sello) }}" height="70" />
        </div>
        @if($paciente->foto_firma)
            <div style="position: fixed; left: 540px; top: 960px">
                <img src="{{ asset('/img/uploads/' . $paciente->foto_firma) }}" height="60" />
            </div>
        @else
            <div style="position: fixed; left: 500px; top: 970px">
                <img src="{{ $paciente->firma_v2 }}" height="70" />
            </div>
            <div style="position: fixed; left: 640px; top: 970px">
                <img src="{{ $paciente->aclaracion_v2 }}" height="70" />
            </div>
        @endif
        

        <div class="bloque bloque7">
            <span>Santa Fe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date_format(date_create($paciente->fe_carga),"d/m/Y") }}</span>
            <span style="position: fixed; left: 600px">Santa Fe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date_format(date_create($paciente->fe_carga),"d/m/Y") }}</span><br/>
        </div>
    </body>
    