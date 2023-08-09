<div class="card">
    <div class="card-footer text-end">
        <div class="d-flex">
            <button class="btn btn-link" onclick="window.history.back();">Volver</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label class="form-label">Nombre y Apellido</label>
                <input type="text" class="form-control" placeholder="" wire:model.defer="paciente.nombre" disabled>
                @error('paciente.nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-sm-6">
              <label class="form-label">DNI</label>
              <input type="text" class="form-control" wire:model.defer="paciente.dni" disabled>
              @error('paciente.dni')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-sm-6">
              <label class="form-label">Fecha de Nacimiento</label>
              <input type="date" class="form-control" width="25" wire:model.defer="paciente.fecha_nac" disabled>
              @error('paciente.fecha_nac')
                  <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3 col-sm-6">
                <label class="form-label">Domicilio</label>
                <input type="text" class="form-control" wire:model.defer="paciente.direccion" disabled>
                @error('paciente.direccion')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-sm-6">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" wire:model.defer="paciente.telefono" disabled>
                @error('telefono')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
                <div class="mb-3 col-sm-6">
                <label class="form-label">E-Mail</label>
                <input type="text" class="form-control" wire:model.defer="paciente.email" disabled>
                @error('paciente.email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </div>
</div>