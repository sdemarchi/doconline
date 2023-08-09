<div class="page pt-5">
  <div class="container-tight container-login py-4">
    <div class="text-center mb-4">
      <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
    </div>
    <div class="text-center mb-4">
      <h1>Turnos Online</h1>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2 class="card-title text-center mb-4"></h2>
        <div class="row">
          <p><strong>Paciente:</strong> {{ $paciente->nombre }}</p>
          <p><strong>DNI:</strong> {{ $paciente->dni }}</strong></p>
          <p><strong>E-mail:</strong> {{ $paciente->email }}</strong></p>


        </div>


        <div class="mb-3 col-sm-12">
          <label class="form-label">Turno Seleccionado</label>
          <input type="text" class="form-control" wire:model.defer="detalle" disabled>

        </div>

        <div class="form-footer">
          <a href="{{ route('turnero.turnos') }}" class="btn btn-secondary">Atrás </a>
          <button class="btn btn-primary float-end" wire:click="avanzar">Siguiente</button>

        </div>
      </div>
    </div>

  </div>
</div>