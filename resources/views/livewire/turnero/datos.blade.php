<div class="page pt-5">
    <div class="container-tight container-datos py-4">
      <div class="text-center mb-4">
        <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300"/></a>
      </div>
      <div class="text-center mb-4">
        <h1>Turnos Online</h1>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Completá tus Datos</h2>
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
            
          <div class="form-footer">
            <a  href="{{ route('turnero') }}" class="btn btn-secondary">Atrás </a>
            <button class="btn btn-primary" wire:click="guardar">Continuar</button>
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
</script>
@endpush