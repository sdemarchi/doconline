<head>
    <link href="https://fonts.cdnfonts.com/css/axiforma" rel="stylesheet">
    <style>

    body {
        font-family: 'Axiforma', sans-serif;
        color: #505050;
    }

    @page { size: 10.5cm 14cm; }

    html {
        margin: 0 10px 0 0;
        padding: 0px;
    }
    
    .imagen{
        image-resolution: from-image;
    }

    .col-izq{
        width: 50%;
        float: left;
    }
    
    .col-der{
        font-size: 14px;
        padding-top: 15px;
        padding-right: 40px;
        width: 50%;
        float: right;
        text-align: right;
    }

    .fila-datos{
        clear: both;
        font-size: 11px;
        line-height: 11px;
        padding-left: 60px;
        z-index: 500;
    }

    .rp{
        font-size: 14px;
        font-weight: bold;
    }
     .nombre{
        text-transform: uppercase;
     }

    .pie{
        position: absolute;
        bottom: 0;
        left:0;
    }

    .firma{
        position: absolute;
        bottom: 50;
        left:115;
        z-index: 200;
    }
    </style>
    </head>
    <body>
        
        <div class="row">
            <div class="col col-izq">
                <img class="imagen" src= "{{ asset("/img/formularios/fondo-recetario.png")}}" width="160" />
            </div>
            <div class="col col-der">
                <p>Fecha: <br/>
                    {{ date_format(date_create( $receta->fecha),"d-m-Y") }}</p>
                    <br/><br/>
                <p class="rp">RP/</p>
            </div>
        </div>
        <div class="row fila-datos">
            <p>Nombre y Apellido:<br/><span class="nombre">{{ $receta->nombre}}</span></p>
            <p>DNI:<br/>{{ $receta->dni}}</p>
            <p>OBRA SOCIAL:<br/>{{ $receta->obra_social}}</p>
            <p>{{ $receta->detalle}}</p>
            @if($receta->diagnostico)<p>DIAGNOSTICO:<br/>{{ $receta->diagnostico}}</p>@endif
            
        </div>
        <img class="imagen firma" src="{{ asset('/img/uploads/' . $medico->firma) }}" height="70" />
        <img class="imagen pie" src= "{{ asset("/img/formularios/pie-recetario-2.png")}}" width="400" />
            
    </body>
    