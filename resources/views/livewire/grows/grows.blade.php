<div class="row row-cards">
    <style>

        tr{
            height: fit-content;
            padding:0;
        }

        tr:hover{
            background-color:#ffffff0f;
            cursor:pointer !important;
        }

    </style>



    <div class="col-12">
        <div class="card">

            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <button wire:click='generarCSV' class="btn btn-primary" style="border-radius:6px;height:26px;font-size:14px">Descargar CSV</button>
                    <div class="me-auto text-muted">
                        <div class="ms-2 d-inline-block mx-auto">
                            <input style="border-radius:6px;height:26px;" type="text" class="form-control form-control-sm" placeholder="Buscar Grow"
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
                                <a class="btn btn-ghost-light btn-icon"  style='margin:0 !important;padding:0 !important;'
                                    href="{{route('grows.edit',$grow->idgrow)}}" data-toggle="tooltip"
                                    data-placement="right" title="Editar">
                                    <img src="{{ asset('svg/edit.svg') }}" alt="edit">
                                </a>
                                <button class="btn btn-ghost-light btn-icon" style='margin:0 !important:padding:0 !important;'
                                    wire:click="$emit('triggerDelete',{{ $grow->idgrow }})"
                                    data-toggle="tooltip" data-placement="right" title="Eliminar Registro">
                                    <img src="{{ asset('svg/delete.svg') }}" alt="delete">
                                </button>
                            </td>

                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->idgrow }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->nombre }}</td>
                            <td><a href="https://wa.me/{{ $grow->celular }}" target="_blank">
                                <img src="{{ asset('img/logo-whatsapp.png')}}" width="20" /></a></td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->activo ? 'Sí' : 'No'}}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ date_format(date_create($grow->fe_ingreso),"d/m/Y") }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>@if($grow->provincia){{ $grow->provincia->Provincia }}@endif</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->cbu }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->alias }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->titular }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->mail }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->instagram }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->celular }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->localidad }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->direccion }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->cp }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->cod_desc }}</td>
                            <td wire:click='abrirGrow({{$grow->idgrow}})'>{{ $grow->observ }}</td>
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
