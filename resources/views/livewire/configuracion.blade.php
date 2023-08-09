<div class="card">
    <div class="card-footer text-end">
        <div class="col">
            <button wire:click="update" class="btn btn-primary float-end">Guardar</button>

        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-6">
                    <label class="form-label">Precio pago por transferencia</label>
                    <input type="text" class="form-control" wire:model.defer="precioTransf">
                    @error('precioTransf')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="col-6">
                    <label class="form-label">Precio pago por Mercado Pago</label>
                    <input type="text" class="form-control" wire:model.defer="precioMP">
                    @error('precioMP')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="col-10">
                    <label class="form-label">CBU</label>
                    <input type="text" class="form-control" wire:model.defer="CBU">
                    @error('CBU')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="col-10">
                    <label class="form-label">Alias cuenta bancaria</label>
                    <input type="text" class="form-control" wire:model.defer="Alias">
                    @error('Alias')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-md-6 mt-3">
                <div class="col-lg-6">
                    <label class="form-label">Orden de prioridad Turnos</label>
                    <select class="form-select" wire:model.defer="OrdenTurnos">
                        <option value="ASC">Primero más temprano</option>
                        <option value="DESC">Primero más tarde</option>
                      </select>
                </div>
            </div>

        </div>
    </div>
</div>