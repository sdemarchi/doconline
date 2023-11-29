<div class="row row-cards">
    <div class="col-12">
        <div class="card">

            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="me-auto text-muted">
                        <div class="ms-2 d-inline-block mx-auto">
                            <input type="text" class="form-control form-control-sm" placeholder="Buscar Grow"
                                wire:model.defer="searchString" wire:keydown.enter="resetPagination">
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="sorting" wire:click="sort('idgrow')">N°
                                <x-sort-icon :sortField="$idgrowSort" />
                            </th>
                            <th class="sorting" wire:click="sort('nombre')">Nombre
                                <x-sort-icon :sortField="$nombreSort" />
                            </th>
                            <th>Whatsapp</th>
                            <th class="sorting" wire:click="sort('activo')">Activo
                                <x-sort-icon :sortField="$activoSort" />
                            </th>
                            <th class="sorting" wire:click="sort('fe_ingreso')">F. Ingreso
                                <x-sort-icon :sortField="$fe_ingresoSort" />
                            </th>
                            <th class="sorting" wire:click="sort('idprovincia')">Provincia
                                <x-sort-icon :sortField="$idprovinciaSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('cbu')">CBU
                                <x-sort-icon :sortField="$cbuSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('alias')">Alias
                                <x-sort-icon :sortField="$aliasSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('titular')">Titular
                                <x-sort-icon :sortField="$titularSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('mail')">Mail
                                <x-sort-icon :sortField="$mailSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('instagram')">Instagram
                                <x-sort-icon :sortField="$instagramSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('celular')">Celular
                                <x-sort-icon :sortField="$celularSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('localidad')">Localidad
                                <x-sort-icon :sortField="$localidadSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('direccion')">Dirección
                                <x-sort-icon :sortField="$direccionSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('cp')">CP
                                <x-sort-icon :sortField="$cpSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('cod_desc')">Cod. Desc.
                                <x-sort-icon :sortField="$cod_descSort" />
                            </th>
                            <th width=200 class="sorting" wire:click="sort('observ')">Observaciones
                                <x-sort-icon :sortField="$observSort" />
                            </th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($grows as $grow)
                        <tr>
                            <td>
                                <a class="btn btn-ghost-light btn-icon"
                                    href="{{route('grows.edit',$grow->idgrow)}}" data-toggle="tooltip"
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
                                    wire:click="$emit('triggerDelete',{{ $grow->idgrow }})"
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
                            <td>{{ $grow->idgrow }}</td>
                            <td>{{ $grow->nombre }}</td>
                            <td><a href="https://wa.me/{{ $grow->celular }}" target="_blank">
                                <img src="{{ asset('img/logo-whatsapp.png')}}" width="25" /></a></td>
                            <td>{{ $grow->activo ? 'Sí' : 'No'}}</td>
                            <td>{{ date_format(date_create($grow->fe_ingreso),"d/m/Y") }}</td>
                            <td>@if($grow->provincia){{ $grow->provincia->Provincia }}@endif</td>
                            <td>{{ $grow->cbu }}</td>
                            <td>{{ $grow->alias }}</td>
                            <td>{{ $grow->titular }}</td>
                            <td>{{ $grow->mail }}</td>
                            <td>{{ $grow->instagram }}</td>
                            <td>{{ $grow->celular }}</td>
                            <td>{{ $grow->localidad }}</td>
                            <td>{{ $grow->direccion }}</td>
                            <td>{{ $grow->cp }}</td>
                            <td>{{ $grow->cod_desc }}</td>
                            <td>{{ $grow->observ }}</td>
                        @endforeach

                    </tbody>
                </table>
                {{ $grows->links() }}
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
                  text: 'Se eliminará el Registro del Grow',
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
