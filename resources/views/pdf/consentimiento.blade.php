<head>
    
    <style>
    body {
        background-image: url({{ asset("/img/formularios/consentimiento1.jpg")}});
        background-repeat: no-repeat;
        background-size: 21cm;
        color: #000;
    }

    .page2{
        background-image: url({{ asset("/img/formularios/consentimiento2.jpg")}});
        background-size: 21cm;
        color: #000;
    }

    html {
        margin: 0px;
        padding: 0px;
    }
    
    .bloque {
        position: absolute;
        line-height: 18.6px;
        font-family: "Poppins", sans-serif;
        font-size: 12px;
    }

    .bloque1{
        top: 107px;
        left: 50px;
    }

    .bloque2{
        top: 330px;
        left: 70px;
    }

    .bloque3{
        top: 462px;
        left: 210px;
    }

    .bloque4{
        top: 620px;
        left: 70px;
    }

    .page_break { page-break-before: always; }

    </style>
    </head>
    
    <body>
    
        <div class="bloque bloque1">
            <span style="position: fixed; left: 170px">{{ $paciente->nom_ape }}</span>
            <span style="position: fixed; left: 555px"> {{ $paciente->dni }}</span> <br/>
            <span style="position: fixed; left: 200px"> {{ $paciente->domicilio }}</span> <br/>
            @if($paciente->es_menor)
                <span style="position: fixed; left: 240px"> {{ $paciente->tut_apeynom }}</span>
            @endif
            <br/>
            <span style="position: fixed; left: 440px"> {{ $medico->apeynom }}</span> <br/>
            <span style="position: fixed; left: 127px"> {{ $medico->matricula }}</span>
            <span style="position: fixed; left: 290px"> {{ $medico->domicilio }}</span> <br/>
        
        </div>

        <div class="bloque bloque2">
            <span>{{ $paciente->diagnostico }}</span>
        </div>

        <div class="bloque bloque3">
            <span>{{ $paciente->cant_plantas }} plantas</span><br/>
            <span>{{ $paciente->dosis }}</span><br/>
            <span>{{ $paciente->conc_thc }}%</span><br/>
            <span>{{ $paciente->conc_cbd }}%</span><br/>
            <span>{{ $paciente->frecuencia }}</span><br/>
        </div>
        
        <div class="bloque bloque4">
            <span>{{ $paciente->beneficios }}</span>
        </div>

        <div style="position: relative; left: 80px; top: 700px">
            <img src="{{ asset('/img/uploads/' . $medico->firma) }}" height="80" />
        </div>
        @if($paciente->foto_firma)
            <div style="position: relative; left: 70px; top: 760px">
                <img src="{{ asset('/img/uploads/' . $paciente->foto_firma) }}" height="80" />
            </div>
        @else
            <div style="position: relative; left: 50px; top: 780px">
                <img src="{{ $paciente->firma_v2 }}" height="70" />
            </div>
            <div style="position: relative; left: 220px; top: 710px">
                <img src="{{ $paciente->aclaracion_v2 }}" height="70" />
            </div>
        @endif
    

    

        
    
    </body>
    <body class="page2">
        <div class="bloque" style="position: fixed; left: 470px; top: 689px">
            <span>Santa Fe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $dia }}</span><br/>
        </div>
        <div class="bloque" style="position: fixed; left: 80px; top: 708px">
            <span>{{ $mes }} </span><span style="position: fixed; left: 233px;">{{ $anio }}</span>
        </div>
        
        <div style="position: relative; left: 80px; top: 735px">
            <img src="{{ asset('/img/uploads/' . $medico->firma) }}" height="80" />
        </div>
        @if($paciente->foto_firma)
            <div style="position: relative; left: 70px; top: 770px">
                <img src="{{ asset('/img/uploads/' . $paciente->foto_firma) }}" height="80" />
            </div>
        @else
            <div style="position: relative; left: 50px; top: 800px">
                <img src="{{ $paciente->firma_v2 }}" height="70" />
            </div>
            <div style="position: relative; left: 220px; top: 730px">
                <img src="{{ $paciente->aclaracion_v2 }}" height="70" />
            </div>
        @endif
        
    

    
    </body>

    