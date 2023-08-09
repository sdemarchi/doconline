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
          <div class="row">
            <div class="col-sm-6 px-4">
              <h3 class="mb-4">Mis Datos</h3>
              <div class="row">
                <div class="mb-3 col-sm-6">
                  <label class="form-label">DNI</label>
                  <input type="text" class="form-control" wire:model.defer="paciente.dni">
                  @error('paciente.dni')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3 col-sm-6">
                  <label class="form-label">Fecha de Nacimiento</label>
                  <input type="date" class="form-control" width="25" wire:model.defer="paciente.fecha_nac">
                  @error('paciente.fecha_nac')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="mb-3 col-sm-12">
                <label class="form-label">Nombre y Apellido</label>
                <input type="text" class="form-control" placeholder="" wire:model.defer="paciente.nombre">
                @error('paciente.nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <!--<div class="mb-3 col-sm-12">
                <label class="form-label">Domicilio</label>
                <input type="text" class="form-control" wire:model.defer="paciente.direccion">
                @error('paciente.direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>-->
              <div class="row">
                <div class="mb-1 col-sm-6">
                  <label class="form-label">Celular</label>
                  <input type="text" class="form-control" wire:model.defer="paciente.telefono">
                  @error('paciente.telefono')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-1 col-sm-6">
                  <label class="form-label">Confirmá tu Celular</label>
                  <input type="text" class="form-control" wire:model.defer="telefono_conf" id="tel-conf">
                  @error('telefono_conf')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <span>ESCRIBÍ TU NUMERO CON CARACTERÍSTICA, SIN 0 NI 15. NO SE ADMITEN PUNTOS, COMAS, GUIONES NI ESPACIOS</span>
              </div>
              
              <div class="row">
                <div class="mb-3 col-sm-6 mt-3">
                  <label class="form-label">E-Mail</label>
                  <input type="text" class="form-control" wire:model.defer="paciente.email" @if($paciente->es_gmail) disabled @endif>
                  @error('paciente.email')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3 col-sm-6 mt-3">
                  @if(!$paciente->es_gmail)
                    <label class="form-label">Confirmá tu E-Mail</label>
                    <input type="text" class="form-control" wire:model.defer="email_conf" id="email-conf">
                    @error('email_conf')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  @endif
                </div>
              </div>
              <button class="btn btn-primary" wire:click="guardarDatos">Guardar Datos</button>
            </div>
            <div class="col-sm-6 px-4">
              <h3 class="mb-4">Mis Turnos</h3>
              <div class="row">
                @if($hayTurnos)
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
                @else
                <div class="mb-3">
                  <span>No tenés turnos pendientes</span>
                </div>
                @endif
                
                
              </div>
              @if(!$hayTurnos)<button class="btn btn-primary mt-2" wire:click="nuevoTurno">Nuevo Turno</button>@endif
              @if($formularioIncompleto)<a class="btn btn-warning mt-2 ms-1" href="{{ route('home') }}">Formulario REPROCANN</a>@endif
            </div>
          </div>
          
          <div class="form-footer">
            <a class="btn btn-secondary me-3 mt-2" href="{{ route('turnero') }}">Atrás</a>
            
          </div>
        </div>
      </div>
      
    </div>
  </div>

  @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      const confTel = document.getElementById('tel-conf');
      confTel.onpaste = e => e.preventDefault(); 
      const confEmail = document.getElementById('email-conf');
      confEmail.onpaste = e => e.preventDefault();   
    });

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