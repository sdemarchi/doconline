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
              <th>Fecha</th>
              <th>Hora</th>
              <th>Fecha Emisión</th>
              <th>Asignado a</th>
              <th>Atendido</th>
             <!-- <th>Pagado</th> -->
              <th></th>
            </tr>
          </thead>
          <tbody>

            @foreach($turnos as $turno)
            <tr>

              <td>{{ $turno->id }}</td>
              <td>{{ date_format(date_create($turno->fecha),"d/m/Y") }}
                <button class="btn btn-ghost-light btn-icon" wire:click="irCalendario({{ $turno->id }})"
                      data-toggle="tooltip" data-placement="right" title="Ir al Calendario">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                        <line x1="16" y1="3" x2="16" y2="7"></line>
                        <line x1="8" y1="3" x2="8" y2="7"></line>
                        <line x1="4" y1="11" x2="20" y2="11"></line>
                        <rect x="8" y="15" width="2" height="2"></rect>
                     </svg>
                    </button>
              </td>
              <td>{{ $turno->hora }}</td>
              <td>@if($turno->fecha_emision){{ date_format(date_create($turno->fecha_emision),"d/m/Y") }}@endif</td>
              <td>
                @if($turno->paciente)
                  {{ $turno->paciente->nombre }}
                @endif
              </td>
              <td>
                @if($turno->paciente)
                  @if ($turno->atendido)
                    <span class="badge bg-success me-1"></span>Sí
                  @else
                    <span class="badge bg-danger me-1"></span>No
                  @endif
                @endif
              </td> <!--
              <td>
                @if($turno->comprobante_pago)
                  <span class="badge bg-success me-1"></span>Sí
                  @if ($turno->comprobante_pago == "mercadopago")
                    <span class="badge bg-azure">MP</span>
                  @else
                    <a href="{{ url('img/uploads/' . $turno->comprobante_pago) }}" target="_blank"><img src="{{ asset('img/icon-decl.png')}}" width="25"/></a>
                  @endif

                  @endif
              </td> -->
              <td>
                <div class="dropdown">
                  <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                    data-bs-toggle="dropdown">
                    Acciones
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    @if($turno->paciente_id)
                      @if ($turno->atendido)
                      <button class="dropdown-item" wire:click="noAtendido('{{ $turno->id }}')">
                        No Atendido
                      </button>
                      @else
                      <button class="dropdown-item" wire:click="atendido('{{ $turno->id }}')">
                        Atendido
                      </button>
                      <button class="dropdown-item" wire:click="$emit('triggerCancel',{{ $turno->id }})">
                        Cancelar
                      </button>
                      @endif
                      <button class="dropdown-item" wire:click="mailConfirmacionTurno('{{ $turno->id }}')">
                        Enviar mail de confirmación
                      </button>
                    @else
                      <button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $turno->id }})">
                        Eliminar
                      </button>

                    @endif
                    <a class="dropdown-item" href="{{route('turnos.edit',$turno->id)}}">Editar</a>
                  </div>
              </td>
            </tr>
            @endforeach

          </tbody>

        </table>
        {{ $turnos->links() }}
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
                  text: 'Se eliminará el Turno',
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
      document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerCancel', itemId => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se cancelará el Turno',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'No cancelar Turno',
                  confirmButtonText: 'Cancelar Turno!'
              }).then((result) => {
          //if user clicks on delete
                  if (result.value) {

                      @this.call('cancelar',itemId)

                  }
              });
          });
      })
  </script>

@endpush
