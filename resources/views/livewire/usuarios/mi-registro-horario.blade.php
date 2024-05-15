<div>
    <div class="row row-cards">
        <style>
            .horas-total{
                background-color:rgba(255, 255, 255, 0.583);
                margin:10px auto;
                padding:2px 5px;
                border-radius: 5px;
                color:rgba(0, 0, 0, 0.866);
                font-weight: 500;
                font-size: 16px;
            }

            .horas-text{
                font-weight: 400;
                font-size: 16px;
                opacity: 85% !important;
            }

        </style>
        <div class="col-12">
            <div class="card">
                <div class="card-body py-3">
                    <div class="row horas-filtros">
                        <div class="col">
                            <h3>Horas trabajadas durante el mes</h3>
                        </div>
                        <div class="col-md-2 col-sm-3 mt-2">
                            <select class="form-select" wire:model="mesActual" wire:click="refresh">
                                @for($i=0;$i<12;$i++)
                                <option value="{{ $i+1 }}">{{ $meses[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-3 mt-1">
                            <select class="form-select" wire:model="anioActual" wire:click="refresh">
                                @for($i=$anioReferencia-10;$i<=$anioReferencia;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="horas-container mt-1">
                        <p class="horas-text text-center m-4 my-1">
                            Horas dias comunes: {{$horasMesComunes}}@if($minutosMesComunes){{":" .$minutosMesComunes}}@endif
                        </p>
                        <p class="horas-text text-center m-4 my-1 mb-3">
                            Horas dias feriado: {{$horasMesFeriado}}@if($minutosMesFeriado){{":" .$minutosMesFeriado}}@endif
                        </p>
                        <p class="text-center m-4 my-2">
                            <span class="horas-total">Total: {{$horasMesTotales}}@if($minutosMesTotales){{":" .$minutosMesTotales}}@endif hs</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom pt-3 pb-4">
                    <h3>Registros de ingreso y egreso</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Total Horas</th>
                                <th>tipo</th>
                                <th>Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($horas as $hora)
                            <tr>
                                <td>{{ date_format(date_create($hora->inicio),"d-m-Y H:i") }}</td>
                                <td>
                                    @if($hora->fin)
                                    {{ date_format(date_create($hora->fin),"d-m-Y H:i") }}
                                    @endif
                                </td>
                                <td>
                                    @if($hora->fin)
                                    {{ $hora->getHorasTrabajadas()}}
                                    @endif
                                </td>
                                <td>
                                    @if($hora->feriado)
                                    {{'feriado (x2)'}}
                                    @endif
                                </td>
                                <td>{{ $hora->comentarios }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $horas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        @this.call('mensaje')
    })
</script>
@endpush
