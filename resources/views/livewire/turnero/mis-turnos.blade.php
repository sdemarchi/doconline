<div class="page pt-5">
    <div class="container">
      <div class="text-center mb-4">
        <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300"/></a>
      </div>
      <div class="text-center mb-4">
        <h1>Turnos Online</h1>
      </div>
      <div class="card card-md">
        <div class="card-body">
            <h2 class="text-center mb-4">Mis Turnos</h1>
            <div class="col-lg-8 mx-auto">
                <div class="row">
                  <div class="table-responsive">
                      <table class="table table-vcenter card-table datatable">
                        <thead>
                          <tr>
                              <th>Fecha</th>
                              <th>Hora</th>
                              <th>Prestador</th>
                              <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($turnos as $turno)
                            <tr>
                              <td>{{ $turno['fecha'] }}</td>
                              <td>{{ $turno['hora'] }}</td>
                              <td>{{ $turno['prestador'] }}</td>
                              <td>
                                  <button class="btn btn-ghost-warning" wire:click="$emit('triggerCancel',{{ $turno['id'] }})">
                                      Cancelar
                                  </button>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div> 
                </div>
            </div>
            <div class="form-footer">
                <a class="btn btn-secondary" href="{{ route('turnero.panel') }}">Atrás</a>
            </div>    
            
        </div>
      </div>
      
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    
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
            
                    @this.call('cancelarTurno',itemId)
            
                }
            });
        });
    })
</script>
  
@endpush