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
                <th>Id</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>E-Mail</th>
                <th>Fecha Emisión</th>
                <th>Turno</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
  
              @foreach($pacientes as $paciente)
              <tr>
  
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->telefono }}</td>
                <td>{{ $paciente->email }}</td>
                <td>@if($paciente->ultimo_turno())
                  @if($paciente->ultimo_turno()->fecha_emision)  
                  {{ date_format(date_create($paciente->ultimo_turno()->fecha_emision),"d/m/Y")}}
                  @endif
                @endif
                </td>
                <td>@if($paciente->ultimo_turno())
                  <span class="badge bg-blue">{{ date_format(date_create($paciente->ultimo_turno()->fecha),"d/m/Y") }} {{ $paciente->ultimo_turno()->hora }}</span>
                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                      data-bs-toggle="dropdown">
                      Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                       <button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $paciente->id }})">
                          Eliminar
                        </button>
                    </div>
                </td>
              </tr>
              @endforeach
  
            </tbody>
  
          </table>
          {{ $pacientes->links() }}
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
                    text: 'Se eliminará el Paciente',
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