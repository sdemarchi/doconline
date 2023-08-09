<div class="card">
    <div class="card-footer text-end">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-primary float-sm-end ms-4 mt-2" wire:click="registrar()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    Registrar</button>

            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Fecha *</label>
                    <input type="date" class="form-control" wire:model.defer="fecha" disabled>
                    @error('fecha')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-4">
                    <label class="form-label">Hora *</label>
                    <input type="time" class="form-control" wire:model.defer="hora" disabled>
                    @error('hora')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col">
                    <label class="form-label">Comentarios</label>
                    <textarea class="form-control" wire:model.defer="comentarios" rows="4"></textarea>
                    @error('comentarios')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        
    </div>
</div>