<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom pt-3 pb-4">
                <div class="row">
                    <div class="col-md-4 col-sm-5 mt-1">
                        <h4 style="color:rgba(255, 255, 255, 0.283);font-size:12px;font-weight:400">PRESTADOR</h4>
                        <select class="form-select" wire:change="initDiasDeAnticipacion($event.target.value)" wire:model="prestadorId" style="width:300px;">
                            <option value="0">Seleccione Prestador</option>
                            @foreach($prestadores as $prestador)
                            <option value="{{ $prestador->id }}">{{ $prestador->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            @if($prestadorId)
            <div class="border-bottom pt-3 pb-4">
                <div class="row">
                    <div style="margin-left:18px;width:300px;">
                        <h4 style="color:rgba(255, 255, 255, 0.283);font-size:12px;font-weight:400">DIAS DE ANTICIPACION</h4>
                        <select class="form-select" wire:change="setDiasAnticipacion($event.target.value)" wire:model="prestadorDiasDeAnticipacion">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Durac. Turno (min)</th>
                            <th width="30"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-select" wire:model="diaAgregar">
                                    <option value="">Seleccione Día</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                </select>
                                @error('diaAgregar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="desdeAgregar">
                                @error('desdeAgregar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="hastaAgregar">
                                @error('hastaAgregar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control" wire:model.defer="duracionTurno">
                                @error('duracionTurno')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <button class="btn btn-outline-primary" wire:click="configurarDia">Añadir</button></td>

                            </td>

                        </tr>
                        @foreach($dias as $dia)
                        <tr>
                            <td>{{ $dia->dia() }}</td>
                            <td>{{ $dia->hora_desde }}</td>
                            <td>{{ $dia->hora_hasta }}</td>
                            <td>{{ $dia->duracion_turno }} minutos</td>
                            <td class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon"
                                    wire:click="$emit('triggerDelete',{{ $dia->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', itemId => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se inhabilitarán los turnos para ese día',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec536c',
                    cancelButtonColor: '#aaa',
                    cancelButtonText: 'cancelar',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
            //if user clicks on delete
                    if (result.value) {

                        @this.call('eliminarItem',itemId)

                    }
                });
            });
        })
</script>

@endpush
