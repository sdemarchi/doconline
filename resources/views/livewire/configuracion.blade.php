<div class="card">
    <style>
        .config-inputs-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content:space-around;
            padding-bottom:40px;
        }

        .config-input{
            margin: 15px 10px;
            width: 25%;
            min-width: 300px;
        }

        .config-save-container{
            display: flex;
            justify-content: flex-end;
        }

    </style>

    <div class="card-body">
        <div class="config-save-container">
            <button wire:click="update" class="btn btn-primary m-2">Guardar</button>
        </div>

        <div class="config-inputs-container">


            <div class="config-input">
                <label class="form-label">Precio pago por transferencia</label>
                <input type="text" class="form-control" wire:model.defer="precioTransf">
                @error('precioTransf')<div class="text-danger">{{ $message }}</div>@enderror
            </div>


            <div class="config-input">
                <label class="form-label">Precio pago por Mercado Pago</label>
                <input type="text" class="form-control" wire:model.defer="precioMP">
                @error('precioMP')<div class="text-danger">{{ $message }}</div>@enderror
            </div>


            <div class="config-input">
                <label class="form-label">CBU</label>
                <input type="text" class="form-control" wire:model.defer="CBU">
                @error('CBU')<div class="text-danger">{{ $message }}</div>@enderror
            </div>


            <div class="config-input">
                <label class="form-label">Alias cuenta bancaria</label>
                <input type="text" class="form-control" wire:model.defer="Alias">
                @error('Alias')<div class="text-danger">{{ $message }}</div>@enderror
            </div>


            <div class="config-input">
                <label class="form-label">Orden de prioridad Turnos</label>
                <select class="form-select" wire:model.defer="OrdenTurnos">
                    <option value="ASC">Primero más temprano</option>
                    <option value="DESC">Primero más tarde</option>
                </select>
            </div>

            <div class="config-input">
                <label class="form-label">Link de contenido para redes</label>
                <input type="text" placeholder="Link de contenido" class="form-control" wire:model.defer="Link">
            </div>

        </div>



    </div>
</div>
