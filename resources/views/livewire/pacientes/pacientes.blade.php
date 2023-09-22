<div class="row row-cards">
    <div class="col-12">
        <div class="card" style="min-width: 96vw;min-height:500px">
            <div class="card-body border-bottom py-3" style="max-height:60px">
                <div class="d-flex">

                    <div style="display:flex;align-items:center;" class="me-auto text-muted">
                        <div>
                            <button class="btn btn-danger btn-icon" style="height:30px !important;margin-right:5px;" wire:click="limpiarBusqueda">
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
                            <button class="btn btn-primary" style="height:30px !important;margin-left:5px;" wire:click="buscarPorDatos">Buscar</button>
                        </div>
                        <div>
                            <button class="btn btn-primary" style="height:30px !important;margin-left:5px;" wire:click="buscarPorDNI">Buscar por DNI</button>
                        </div>
                        <div>
                            <button class="btn btn-success" style="height:30px !important;margin-left:25px;" wire:click="generarCsv">Generar CSV</button>
                        </div>
                    </div>

                </div>
            </div>

            <div id="loader">
                @include('components.loader')
            </div>


            <div id="pacientes-table" class="table-responsive">
               <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="sorting" wire:click="sort('fe_carga')">F. Carga
                                <x-sort-icon :sortField="$fe_cargaSort" />
                            </th>
                            <th class="sorting" wire:click="sort('idpaciente')">N°
                                <x-sort-icon :sortField="$idpacienteSort" />
                            </th>
                            <th class="sorting" wire:click="sort('pagado2023')">Pagado 23
                                <x-sort-icon :sortField="$pagado2023Sort" />
                            </th>
                            <th class="sorting" wire:click="sort('estado')">Estado
                                <x-sort-icon :sortField="$estadoSort" />
                            </th>
                            <th class="sorting" wire:click="sort('fe_aprobacion')">F. Aprobac.
                                <x-sort-icon :sortField="$fe_aprobacionSort" />
                            </th>
                            <th class="sorting" wire:click="sort('idcontacto')">Modo Contacto
                                <x-sort-icon :sortField="$idcontactoSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('contacto_otro')">Contacto Otro
                                <x-sort-icon :sortField="$contacto_otroSort" />
                            </th>
                            <th>Decl.</th>
                            <th>Cons.</th>
                            <th>Wsp</th>
                            <th>Foto Firma</th>
                            <th>Firma</th>
                            <th>Aclaración</th>
                            <th width=200 class="sorting" wire:click="sort('nom_ape')">Nombre y Apellido
                                <x-sort-icon :sortField="$nom_apeSort" />
                            </th>
                            <th class="sorting" wire:click="sort('dni')">DNI
                                <x-sort-icon :sortField="$dniSort" />
                            </th>
                            <th class="sorting" wire:click="sort('cod_vincu')">Código Vinculación
                                <x-sort-icon :sortField="$cod_vincuSort" />
                            </th>
                            <th class="sorting" wire:click="sort('edad')">Edad
                                <x-sort-icon :sortField="$edadSort" />
                            </th>
                            <th class="sorting" wire:click="sort('ocupacion')">Ocupación o Trabajo
                                <x-sort-icon :sortField="$ocupacionSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('patologia')">Patología
                                <x-sort-icon :sortField="$patologiaSort" />
                            </th>
                            <th width=350 class="sorting" wire:click="sort('res_historia')">Resumen historia clínica
                                <x-sort-icon :sortField="$res_historiaSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('diagnostico')">Diagnóstico
                                <x-sort-icon :sortField="$diagnosticoSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('tratamiento')">Tratamiento
                                <x-sort-icon :sortField="$tratamientoSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('justificacion')">Justificación
                                <x-sort-icon :sortField="$justificacionSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('beneficios')">Beneficios
                                <x-sort-icon :sortField="$beneficiosSort" />
                            </th>
                            <th width=350 class="sorting" wire:click="sort('comentario')">Comentario
                                <x-sort-icon :sortField="$comentarioSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('dolores')">Dolencias
                                <x-sort-icon :sortField="$doloresSort" />
                            </th>
                            <th class="sorting" wire:click="sort('conc_thc')">Conc THC
                                <x-sort-icon :sortField="$conc_thcSort" />
                            </th>
                            <th class="sorting" wire:click="sort('conc_cbd')">Conc CBD
                                <x-sort-icon :sortField="$conc_cbdSort" />
                            </th>
                            <th class="sorting" wire:click="sort('cant_plantas')">Cant Plantas
                                <x-sort-icon :sortField="$cant_plantasSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('dosis')">Dosis
                                <x-sort-icon :sortField="$dosisSort" />
                            </th>
                            <th class="sorting" wire:click="sort('frecuencia')">Frecuencia
                                <x-sort-icon :sortField="$frecuenciaSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('domicilio')">Domicilio
                                <x-sort-icon :sortField="$domicilioSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('localidad')">Localidad
                                <x-sort-icon :sortField="$localidadSort" />
                            </th>
                            <th width=150 class="sorting" wire:click="sort('idprovincia')">Provincia
                                <x-sort-icon :sortField="$idprovinciaSort" />
                            </th>
                            <th class="sorting" wire:click="sort('cp')">CP
                                <x-sort-icon :sortField="$cpSort" />
                            </th>
                            <th class="sorting" wire:click="sort('fe_nacim')">F. Nacimiento
                                <x-sort-icon :sortField="$fe_nacimSort" />
                            </th>
                            <th class="sorting" wire:click="sort('osocial')">O. Social
                                <x-sort-icon :sortField="$osocialSort" />
                            </th>
                            <th class="sorting" wire:click="sort('email')">E-mail
                                <x-sort-icon :sortField="$emailSort" />
                            </th>
                            <th class="sorting" wire:click="sort('celular')">Celular
                                <x-sort-icon :sortField="$celularSort" />
                            </th>
                            <th class="sorting" wire:click="sort('es_menor')">Es Menor
                                <x-sort-icon :sortField="$es_menorSort" />
                            </th>
                            <th class="sorting" wire:click="sort('tut_apeynom')">Tut Apeynom
                                <x-sort-icon :sortField="$tut_apeynomSort" />
                            </th>
                            <th class="sorting" wire:click="sort('tut_tipo_nro_doc')">Tut Tipo Nro Doc
                                <x-sort-icon :sortField="$tut_tipo_nro_docSort" />
                            </th>
                            <th class="sorting" wire:click="sort('tut_vinculo')">Tut Vinculo
                                <x-sort-icon :sortField="$tut_vinculoSort" />
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                        <tr>
                            <td>
                                <a class="btn btn-ghost-light btn-icon"
                                    href="{{route('pacientes.edit',$paciente->idpaciente)}}" data-toggle="tooltip"
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
                                <button class="btn btn-ghost-light btn-icon"
                                    wire:click="$emit('triggerDelete',{{ $paciente->idpaciente }})"
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
                            <td>{{ date_format(date_create($paciente->fe_carga),"d/m/Y") }}</td>
                            <td>{{ $paciente->idpaciente }}</td>
                            <td>{{ $paciente->pagado2023 ? 'Sí' : 'No'}}</td>
                            <td>{{ $paciente->getEstado() }}</td>
                            <td>@if($paciente->fe_aprobacion){{
                                date_format(date_create($paciente->fe_aprobacion),"d/m/Y") }}@endif</td>
                            <td>@if($paciente->modo_contacto){{ $paciente->modo_contacto->modo_contacto }}@endif</td>
                            <td>{{ $paciente->contacto_otro }}</td>
                            <td><a href="{{ route('paciente.declaracion',$paciente->idpaciente) }}" target="_blank"><img
                                        src="{{ asset('img/icon-decl.png')}}" width="25" /></a></td>
                            <td><a href="{{ route('paciente.consentimiento',$paciente->idpaciente) }}"
                                    target="_blank"><img src="{{ asset('img/icon-cons.png')}}" width="25" /></a></td>
                            <td><a href="https://wa.me/{{ $paciente->celular }}" target="_blank">
                                    <img src="{{ asset('img/logo-whatsapp.png')}}" width="25" /></a></td>
                            <td>
                                @if($paciente->foto_firma)
                                <img src="{{ asset("img/uploads/$paciente->foto_firma")}}" width="100"/>
                                @endif
                            </td>
                            <td>

                                <button class="btn btn-ghost-light btn-icon"
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

                                <a class="btn btn-ghost-light btn-icon"
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

                                <img src="{{ $paciente->firma_v2 }}" width="100" />
                            </td>
                            <td><img src="{{ $paciente->aclaracion_v2 }}" width="100" /></td>
                            <td>{{ $paciente->nom_ape }}</td>
                            <td>{{ $paciente->dni }}</td>
                            <td>{{ $paciente->cod_vincu }}</td>
                            <td>{{ $paciente->edad }}</td>
                            <td>{{ $paciente->ocupacion }}</td>
                            <td>{{ $paciente->patologia }}</td>
                            <td>{{ $paciente->res_historia }}</td>
                            <td>{{ $paciente->diagnostico }}</td>
                            <td>{{ $paciente->tratamiento }}</td>
                            <td>{{ $paciente->justificacion }}</td>
                            <td>{{ $paciente->beneficios }}</td>
                            <td>{{ $paciente->comentario }}</td>
                            <td>{!! $paciente->getDolencias() !!}</td>
                            <td>{{ number_format($paciente->conc_thc, 2, ',', '.') }}</td>
                            <td>{{ number_format($paciente->conc_cbd, 2, ',', '.') }}</td>
                            <td>{{ $paciente->cant_plantas }}</td>
                            <td>{{ $paciente->dosis }}</td>
                            <td>{{ $paciente->frecuencia }}</td>
                            <td>{{ $paciente->domicilio }}</td>
                            <td>{{ $paciente->localidad }}</td>
                            <td>@if($paciente->provincia){{ $paciente->provincia->Provincia }}@endif</td>
                            <td>{{ $paciente->cp }}</td>
                            <td>{{ date_format(date_create($paciente->fe_nacim),"d/m/Y") }}</td>
                            <td>{{ $paciente->osocial }}</td>
                            <td>{{ $paciente->email }}</td>
                            <td>{{ $paciente->celular }}</td>
                            <td>{{ $paciente->es_menor ? 'Sí' : 'No' }}</td>
                            <td>{{ $paciente->tut_apeynom }}</td>
                            <td>{{ $paciente->tut_tipo_nro_doc }}</td>
                            <td>{{ $paciente->tut_vinculo }}</td>
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
