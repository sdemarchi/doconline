<div class="row row-cards">
    <style>
        .tc-exentos-card{
            margin-top:25px;
            padding:20px;
        }

        .tc-anticipacion-card{
            margin-bottom:25px;
            padding:20px;
        }

        .tc-title{
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            text-align: left;
            margin:15 0;
            margin-bottom:25px;
        }

        .tc-table-head{
           background-color: rgba(129, 129, 129, 0.04);
           border-radius: 8px;
           border:1px solid rgba(255, 255, 255, 0.094);
        }

    </style>
    <div class="col-12">
        <div class="card tc-anticipacion-card">
            <h2 class="tc-title ">Cambiar dias de anticipacion</h2>
                <div class="row">
                    <div style="width:300px;">
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
        <div class="card">
            <div class="card-body border-bottom pt-3 pb-4">
                <h2 class="tc-title">Configurar franja horaria</h2>
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

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Desde 1</th>
                            <th>Hasta 1</th>
                            <th>Desde 2</th>
                            <th>Hasta 2</th>
                            <th>Desde 3</th>
                            <th>Hasta 3</th>
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
                                <input type="time" class="form-control" wire:model.defer="desdeAgregar1">
                                @error('desdeAgregar1')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="hastaAgregar1">
                                @error('hastaAgregar1')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="desdeAgregar2">
                                @error('desdeAgregar2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="hastaAgregar2">
                                @error('hastaAgregar2')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="desdeAgregar3">
                                @error('desdeAgregar3')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="time" class="form-control" wire:model.defer="hastaAgregar3">
                                @error('hastaAgregar3')
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
                            <td>{{ $dia->hora_desde_1 }}</td>
                            <td>{{ $dia->hora_hasta_1 }}</td>
                            <td>{{ $dia->hora_desde_2 }}</td>
                            <td>{{ $dia->hora_hasta_2 }}</td>
                            <td>{{ $dia->hora_desde_3 }}</td>
                            <td>{{ $dia->hora_hasta_3 }}</td>
                            <td>{{ $dia->duracion_turno }}minutos</td>
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

            @endif
        </div>
        <div class="card tc-exentos-card">
            <h2 class="tc-title">Dias exentos de turnos</h2>

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Dia</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr class="tc-table-head">
                        <td colspan=2><button class="btn btn-outline-primary" wire:click="agregarItem">Agregar</button></td>
                        <td>
                            <input type='date' class="form-control" placeholder="Agregar dolencia" rows="1" wire:model.defer="fechaAgregarDia">
                        </td>
                        <td>
                            <textarea class="form-control" placeholder="Motivo de la exepción" rows="1" wire:model.defer="motivoAgregarDia"></textarea>
                        </td>
                    </tr>
                    @foreach($diasExentos as $index => $dia)
                        <tr>
                            <td class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon" wire:click="$emit('diaDelete',{{ $dia->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </td>
                            <td class="pe-2 p-0">
                                <button class="btn btn-ghost-light btn-icon"  wire:click="guardarItem({{$index}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" />
                                    </svg>
                                </button>
                            </td>
                            <td><input type='date' class="form-control" rows="1" wire:model.defer="diasExentos.{{ $index }}.fecha"></input></td>
                            <td><textarea class="form-control" rows="1"  wire:model.defer="diasExentos.{{ $index }}.motivo"></textarea></td>
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
            @this.on('diaDelete', itemId => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se eliminará el elemento',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec536c',
                    cancelButtonColor: '#aaa',
                    cancelButtonText: 'cancelar',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
            //if user clicks on delete
                    if (result.value) {

                        @this.call('eliminarDia',itemId)

                    }
                });
            });
        })

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
