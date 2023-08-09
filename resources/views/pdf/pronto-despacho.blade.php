<head>
    
    <style>
    body {
        background-size: 21cm;
        color: #000;
    }

    html {
        margin: 80px 100px 60px 140px;
        padding: 0px;
    }
    
    .bloque {
        position: absolute;
        line-height: 26px;
        font-size: 16px;
    }

    .titulo {
        font-size: 18px;
        font-weight: bold;
    }

    
    </style>
    </head>
    <body>
        
        <div class="bloque">
            <p class="titulo">Ministerio de salud de la nación:</p>

              <p>  Al Ministerio de Salud de la Nación, Registro del Programa de Cannabis señor {{ $paciente->nom_ape }} 
                DNI {{ $paciente->dni }}, por mi propio derecho me dirijo a usted a fin de solicitarle en carácter de pronto despacho, 
                la resolución del trámite de inscripción en el registro del programa de cannabis  (REPROCANN), 
                que fuera iniciado con fecha {{ date_format(date_create($paciente->fe_carga),"d/m/Y") }} y al que le fuera asignado 
                el código de vinculación {{ $paciente->cod_vincu }}.
                Motiva la presentación de esta solicitud el silencio de la administración respecto al referido trámite, 
                habiendo transcurrido el plazo de 60 días previsto en el artículo 10 ley 19.549 desde que fuera iniciado. 
                La demora injustificada del mismo causa un prejuicio en mi salud como así también a todos los que nos 
                encontramos en la misma situación y resulta exclusivamente imputable a vuestra inactividad por lo que 
                solicito tengan a bien resolver favorablemente a la brevedad el referido trámite de inscripción.</p>
                <p>Sin otro particular le saludo atentamente.</p> 
        </div>
        
        
    </body>
    