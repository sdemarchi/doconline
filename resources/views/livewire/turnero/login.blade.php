<div class="page pt-5">
    <div class="container-tight container-login py-4">
      <div class="text-center mb-4">
        <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300"/></a>
      </div>
      <div class="text-center mb-4">
        <h1>Turnos Online</h1>
      </div>
      <div class="card card-md">
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Ingresá tus Datos</h2>
          <div class="row">
            <div class="mb-3 col-sm-6">
              <label class="form-label">DNI</label>
              <input type="text" class="form-control" placeholder="Ingresá tu DNI" wire:model.defer="dni">
              @error('dni')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-sm-6">
              <label class="form-label">Fecha de Nacimiento</label>
              <input type="date" class="form-control" width="25" wire:model.defer="fecha_nac">
              @error('fecha_nac')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          
          <div class="form-footer text-center">
            <div class="col">
              <button class="btn btn-primary px-5" wire:click="ingresar">Iniciá Sesión</button>
              <a class="btn login-with-google-btn" href="{{ route('google.login') }}">
                Ingresá con Google
              </a>
              </div>
            
            
          </div>
        </div>
      </div>
      
    </div>
  </div>