<div class="row row-cards">
    <style>
        .p-fila-paciente:hover{
            background-color:#ffffff11;
            cursor:pointer !important;
        }

    </style>
    <div class="col-12">
        <div class="card" style="min-width: 96vw;min-height:500px">
            <div class="card-body border-bottom py-3" style="max-height:60px">
                <div class="d-flex">
                    <div style="display:flex;align-items:center;" class="me-auto text-muted">
                        <div>
                            <button class="btn btn-danger btn-icon" style="height:30px !important;margin-right:8px;" wire:click="limpiarBusqueda">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                            </button>
                        </div>

                        <div>
                            <input id="search-input" style="height:30px;font-size:15px;" type="text" class="form-control form-control-sm" placeholder="búsqueda"
                                wire:model.defer="searchString" wire:keydown.enter="buscarPorDatos">
                        </div>
                        <div>
                            <button class="btn btn-primary" style="height:30px !important;margin-left:8px;" wire:click="buscarPorDatos">Buscar</button>
                        </div>
                        <div>
                            <button class="btn btn-primary" style="height:30px !important;margin-left:8px;" wire:click="buscarPorDNI">Buscar por DNI</button>
                        </div>
                        <div>
                            <button class="btn btn-success" style="height:30px !important;margin-left:8px;" wire:click="generarCsv">Generar CSV</button>
                        </div>
                    </div>

                </div>
            </div>

            <div id="loader">
                @include('components.loader')
            </div>


            <div id="pacientes-table" class="table-responsive">
               <table id="calendario-table" class="table table-vcenter card-table" style="margin-bottom:20px !important;">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="sorting" wire:click="sort('fe_carga')">F. Carga
                                <x-sort-icon :sortField="$fe_cargaSort" />
                            </th>
                            <th class="sorting" wire:click="sort('idpaciente')">N°
                                <x-sort-icon :sortField="$idpacienteSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('nom_ape')">Nombre y Apellido
                                <x-sort-icon :sortField="$nom_apeSort" />
                            </th>
                            <th class="sorting" wire:click="sort('pagado2024')">Pagado {{$anioActual}}
                                <x-sort-icon :sortField="$pagado2024Sort" />
                            </th>
                            <th class="sorting" wire:click="sort('estado')">Estado
                                <x-sort-icon :sortField="$estadoSort" />
                            </th>
                            <th class="sorting" wire:click="sort('fe_aprobacion')">F. Aprobac.
                                <x-sort-icon :sortField="$fe_aprobacionSort" />
                            </th>
                            <th class="sorting" wire:click="sort('email')">E-mail
                                <x-sort-icon :sortField="$emailSort" />
                            </th>
                            <th class="sorting" wire:click="sort('celular')">Celular
                                <x-sort-icon :sortField="$celularSort" />
                            </th>

                            <th>Foto Firma</th>
                            <th style='text-align:center'>Firma</th>
                            <th>Aclaración</th>

                            <th class="sorting" wire:click="sort('dni')">DNI
                                <x-sort-icon :sortField="$dniSort" />
                            </th>

                            <th width=150 class="sorting" wire:click="sort('idprovincia')">Provincia
                                <x-sort-icon :sortField="$idprovinciaSort" />
                            </th>

                            <th class="sorting" wire:click="sort('cant_plantas')">Cant Plantas
                                <x-sort-icon :sortField="$cant_plantasSort" />
                            </th>

                            <th class="sorting" wire:click="sort('idcontacto')">Modo Contacto
                                <x-sort-icon :sortField="$idcontactoSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('contacto_otro')">Contacto Otro
                                <x-sort-icon :sortField="$contacto_otroSort" />
                            </th>
                            <th width=350 class="sorting" wire:click="sort('comentario')">Comentario
                                <x-sort-icon :sortField="$comentarioSort" />
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                        <tr class="p-fila-paciente">
                            <td>
                                <a class="btn btn-ghost-light btn-icon" style="margin:0 !important;padding:0;"
                                    href="{{route('pacientes.edit', $paciente->idpaciente)}}" data-toggle="tooltip"
                                    data-placement="right" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                        </path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                                <button class="btn btn-ghost-light btn-icon" style="margin:5px !important;padding:0;"
                                    wire:click="$emit('triggerDelete', {{ $paciente->idpaciente }})"
                                    data-toggle="tooltip" data-placement="right" title="Eliminar Registro">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </button>
                            </td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ date_format(date_create($paciente->fe_carga),"d/m/Y") }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->idpaciente }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->nom_ape }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})' style="text-align: center;">
                                @if ($pago = $paciente->ultimoPago($anioActual))
                                    {{ ($pago->verificado || $paciente->pagado2024 ) ? 'Sí' : '-'}}
                                @else
                                {{ $paciente->pagado2024  ? 'Sí' : '-'}}
                                @endif
                            </td>

                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->getEstado() }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>@if($paciente->fe_aprobacion){{
                                date_format(date_create($paciente->fe_aprobacion),"d/m/Y") }}@endif</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->email }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->celular }}</td>

                            <td>
                                @if($paciente->foto_firma)
                                <img src="{{ asset("img/uploads/$paciente->foto_firma")}}" style='max-width:70px;max-height:20px;margin:0 10px;'/>
                                @endif
                            </td>

                            <td>
                                <button class="btn btn-ghost-light btn-icon" style="margin:0 !important;padding:0;"
                                    wire:click="convertirFirmaAclaracion({{ $paciente->idpaciente }})"
                                    data-toggle="tooltip" data-placement="right" title="Importar Firma y Aclaración">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/user-off -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                    </svg>
                                </button>

                                <a class="btn btn-ghost-light btn-icon" style="margin:0 !important;padding:0;"
                                    href="{{route('pacientes.editFirma',$paciente->idpaciente)}}" data-toggle="tooltip"
                                    data-placement="right" title="Editar Firma y Aclaración">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                        </path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>

                                <img src="{{ $paciente->firma_v2 }}" style='max-width:70px;max-height:20px;margin:0 10px;'/>
                            </td>
                            <td><img src="{{ $paciente->aclaracion_v2 }}"  style='max-width:70px;max-height:20px;margin:0 10px;'/></td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->dni }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>@if($paciente->provincia){{ $paciente->provincia->Provincia }}@endif</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->cant_plantas }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>@if($paciente->modo_contacto){{ $paciente->modo_contacto->modo_contacto }}@endif</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->contacto_otro }}</td>
                            <td wire:click='abrirFicha({{$paciente->idpaciente}})'>{{ $paciente->comentario }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $pacientes->links() }}


                @if(count($pacientes)== 0)
                <div style="width:100vw;display:flex;align-items:center;justify-content:center;height:200px;">
                    <div>No hay coincidencias para la busqueda</div>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    let loader;
    let table;
    let searchInput;

    document.addEventListener('DOMContentLoaded', function () {
        loader = document.querySelector("#loader");
        table = document.querySelector("#pacientes-table");
        searchInput = document.querySelector("#search-input");

        Livewire.on('searchCompleted', () => {
          loader.style.zIndex = "-1";
        });

        searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            table.style.opacity = "0";
            loader.style.zIndex = "8000";
        }});
    });

    document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerDelete', itemId => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se eliminará el Registro del Paciente',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'cancelar',
                  confirmButtonText: 'Eliminar!'
              }).then((result) => {
                  if (result.value) {
                      @this.call('eliminar',itemId)
                  }
              });
          });
      })


</script>

@endpush
