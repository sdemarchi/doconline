<div>
    <style>
        .ingreso-columns{
            display: flex;
        }

        .ingreso-columns > div{
            padding:15px;
        }

        .ingreso-header{
            background-color:rgba(0, 0, 0, 0.129);
            font-weight: 500;
            border-radius: 8px 8px 0 0;
            text-align: center;
            padding: 8px 0px;
            margin-bottom:15px;
        }

        .ingreso-content{
            border-radius: 8px;
            margin: auto auto;
            max-width: 800px;
            width: 800px;
            box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.097);
            max-width: 94vw !important;
        }

        .ingreso-buttons-container{
            display:flex;
            justify-content: center;
        }

        .ingreso-buttons-container > button{
            margin: 15px 5px;
        }

        .ingreso-background{
            position:fixed;
            top:0;
            left:0;
            min-width:100vw;
            min-height:100vh;
            display:flex;
            flex-direction:row;
            align-items:center;
            padding:15px;
            color:rgb(255, 255, 255);
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 8000;
        }
    </style>

    <div class="ingreso-background">
        <div class="ingreso-content card">
            <div class="ingreso-header">Registrar egreso</div>
            <div class="ingreso-columns">

                <div class="col">
                    <div class="row mb-3">
                        <label class="form-label">Fecha *</label>
                        <input type="date" class="form-control" wire:model.defer="fecha" disabled>
                        @error('fecha')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Hora *</label>
                        <input type="time" class="form-control" wire:model.defer="hora" disabled>
                        @error('hora')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="col">
                    <div class="row mb-3">
                        <label class="form-label">Comentarios</label>
                        <textarea type="time" class="form-control" wire:model.defer="comentarios" rows="4"></textarea>
                        @error('comentarios')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="ingreso-buttons-container">
                <button class="btn btn-primary" wire:click="registrar()">Registrar</button>
                <button type="button" class="btn egreso-switch">Cancelar</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            setInterval(function () {
                var now = new Date();
                var fecha = now.toISOString().slice(0, 10);
                var hora = now.getHours() + ':' + now.getMinutes();
                Livewire.emit('actualizarFechaYHora', fecha, hora);
            }, 30000);
        });
    </script>
</div>
