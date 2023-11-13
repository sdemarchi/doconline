<div class="card">
    <div class="card-footer text-end" style="margin:0">
        <button class="btn btn-link float-start" onclick="window.history.back();">Volver</button>
        <button class="btn btn-primary float-sm-end ms-4 mt-2" wire:click="update()">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                <circle cx="12" cy="14" r="2"></circle>
                <polyline points="14 4 14 8 8 8 8 4"></polyline>
            </svg>Guardar</button>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-8">
                    <label class="form-label">Prestador *</label>
                    <select class="form-select" wire:model.defer="prestadorId">
                        <option value="">Seleccione Prestador</option>
                        @foreach($prestadores as $pr)
                            <option value="{{ $pr->id }}">{{ $pr->nombre }}</option>
                        @endforeach
                    </select>
                    @error('prestadorId')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Fecha *</label>
                    <input type="date" class="form-control" wire:model.defer="fecha">
                    @error('fecha')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-4">
                    <label class="form-label">Hora *</label>
                    <input type="time" class="form-control" wire:model.defer="hora">
                    @error('hora')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>


    </div>
</div>
