<div class="card">
    <div class="card-body pt-3">
        <div class="row">
            <div class="col-md-6 mt-4">
              <label class="form-label">Nombre y Apellido *</label>
              <input type="text" class="form-control" wire:model.defer="name">
              @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mt-4">
                <label class="form-label">Nombre de Usuario *</label>
                <input type="text" class="form-control" wire:model.defer="username">
                @error('username')<div class="text-danger">{{ $message }}</div>@enderror
              </div>

        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <label class="form-label">E-Mail *</label>
                <input type="text" class="form-control" wire:model.defer="email">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mt-4">
                <div class="col-lg-6">
                    <label class="form-label">Rol del Usuario</label>
                    <select class="form-select" wire:model.defer="role_id">
                        <@foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" wire:model.defer="password">
                @error('password')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mt-4">
                <label class="form-label">Pago por hora</label>
                <input type="number" class="form-control" wire:model.defer="pago_hora">
            </div>
        </div>

        <div style="display:flex;align-items:center;justify-content:center;margin:50px 0;min-width:100%">
            <button class="btn btn-link float-start" style="margin-right:20px" onclick="window.history.back();">Volver</button>
            <button class="btn btn-primary" wire:click="update()">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                    <circle cx="12" cy="14" r="2"></circle>
                    <polyline points="14 4 14 8 8 8 8 4"></polyline>
                </svg>
                Guardar</button>
        </div>

    </div>
</div>
