<div class="row row-cards">
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            <div class="ms-auto text-muted">
              <div class="ms-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar Paciente"
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
                <th class="sorting" wire:click="sort('id')">Id
                    <x-sort-icon :sortField="$idSort"/>
                </th>
                <th class="sorting" wire:click="sort('fecha')">Fecha
                    <x-sort-icon :sortField="$fechaSort"/>
                </th>
                <th class="sorting" wire:click="sort('nombre')">Paciente
                    <x-sort-icon :sortField="$nombreSort"/>
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
  
              @foreach($recetas as $receta)
              <tr>
                <td>
                  <a class="btn btn-ghost-light btn-icon" href="{{route('recetas.edit',$receta->id)}}"
                    data-toggle="tooltip" data-placement="right" title="Editar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                      <path d="M16 5l3 3"></path>
                  </svg>
                  </a>
                  <a href="{{ route('receta.impresion',$receta->id) }}" target="_blank"><img src="{{ asset('img/icon-decl.png')}}" width="25"/></a>
                  
                </td>
                <td>{{ $receta->id }}</td>
                <td>{{ date_format(date_create($receta->fecha),"d/m/Y") }}</td>
                <td>{{ $receta->nombre }}</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                      data-bs-toggle="dropdown">
                      Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('recetas.edit',$receta->id)}}">Editar</a>
                        <button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $receta->id }})">
                          Eliminar
                        </button>
                    </div>
                </td>
              </tr>
              @endforeach
  
            </tbody>
  
          </table>
          {{ $recetas->links() }}
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
                    text: 'Se eliminará la Receta',
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