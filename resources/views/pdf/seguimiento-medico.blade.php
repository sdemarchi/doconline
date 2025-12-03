<body>
    <p><strong>Dr. Joaquín A. Jozami – Médico Director</strong></p>
    <p>Fecha: {{ date('d/m/Y') }}</p>
    <hr>

    @foreach ($segList as $seg)
        <h3>Seguimiento del paciente</h3>

        <p><strong>Nombre:</strong> {{ $seg->paciente->nom_ape }}</p>
        <p><strong>DNI:</strong> {{ $seg->paciente->dni }}</p>
        <p><strong>Edad:</strong> {{ $seg->paciente->edad }}</p>
        <p><strong>Diagnóstico:</strong> {{ $seg->paciente->diagnostico }}</p>
        <p><strong>Procedimiento propuesto:</strong> {{ $seg->proc_propuesto }}</p>
        <p><strong>Dósis:</strong> {{ $seg->dosis_text }}</p>
        <p><strong>Concentración:</strong> {{ $seg->concentracion}}</p>
        <p><strong>Ratio:</strong> {{ $seg->ratio }}</p>
        <p><strong>Dilución:</strong> {{ $seg->disolucion }}</p>
        <p><strong>Dosificaciones:</strong> {{ $seg->dosificaciones }}</p>
        <p><strong>Tipo y frecuencia analítica:</strong> {{ $seg->tipo_frec_analitica }}</p>
        <p><strong>Beneficios razonables:</strong> {{ $seg->beneficios_razonables }}</p>
        <p><strong>Evolución:</strong> {{ $seg->evolucion }}</p>
        <p><strong>Observaciones:</strong> {{ $seg->observaciones }}</p>

        <hr>
    @endforeach

    @if($segList->count() == 0)
        <p>No hay seguimientos médicos disponibles para esta ONG.</p>
    @endif

    @if($medico->firma)
    <img class="imagen firma"  style="margin-top:40px" src="{{ asset('/img/uploads/' . $medico->firma) }}" height="75" />
    @endif
    @if($medico->sello)
    <img class="imagen sello"  style="margin-top:40px"  src="{{ asset('/img/uploads/' . $medico->sello) }}" height="50" />
    @endif
</body
