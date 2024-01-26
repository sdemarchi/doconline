<div>
    <style>
        .pago-inputs-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content:space-around;
        }

        .pago-input {
            margin: 15px 10px;
            width: 25%;
            min-width: 300px;
        }

        .pago-input input {
            width: 100%;
        }

        .pago-buttons-edit-delete{
            margin:6px 10px;
            width: fit-content;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        .pago-button{
            background-color:#626976;
            border:none;
            border-radius: 4px;
            color:rgb(255, 255, 255);
            font-weight: 500;
            padding:4px 12px;
            margin:6px 4px;
            height:fit-content;
            min-width: max-content;
            font-size:13px;
            display: flex;
            flex-direction: row;
            align-items: center;
            min-height: 30px;
        }

        .pago-button:hover{
            text-decoration: none;
            color:rgb(236, 236, 236);
            opacity:90%;
        }

        .pago-delete-button{
            background-color: rgb(223, 66, 66);
        }

        .pago-wsp-button{
            background-color: rgb(68, 193, 72);
        }

        .pago-wsp-button:hover{
            background-color: rgb(51, 197, 56);
        }

        .pago-save-button{
            background-color: rgb(47, 103, 208);
        }

    </style>

    <div class="card">
        <div class="card-footer ">
            <label class="form-check form-switch float-sm-start ms-2 mt-1" style='max-width:fit-content'>
                <input class="form-check-input" type="checkbox" wire:model.defer="verificado" wire:change="verificadoSwitch">
                <span class="form-check-label">Verificado</span>
            </label>

            <label class="form-check form-switch float-sm-start ms-2 mt-1" style='max-width:fit-content'>
                <input class="form-check-input" type="checkbox" wire:model.defer="utilizado" wire:change="utilizadoSwitch">
                <span class="form-check-label">Utilizado</span>
            </label>
        </div>

        <div class="card-body border-bottom pt-3 pb-4" >
            <div class='pago-inputs-container'>

                <div class="pago-input"><label class="form-label">Id Paciente</label>
                    <input disabled type="text" class="form-control" wire:model.defer="idPaciente">
                </div>

                <div class="pago-input"><label class="form-label">Nombre Paciente</label>
                    <input disabled type="text" class="form-control" wire:model.defer="nombrePaciente">
                </div>

                <div class="pago-input"><label class="form-label">Email paciente</label>
                    <input disabled type="text" class="form-control" wire:model.defer="emailPaciente">
                </div>

                <div class="pago-input"><label class="form-label">Pagador</label>
                    <input disabled type="text" class="form-control" wire:model.defer="nombrePagador">
                </div>

                <div class="pago-input">
                    <label disabled class="form-label">Email pagador</label>
                    <input type="text" class="form-control" wire:model.defer="emailPagador">
                </div>

                <div class="pago-input">
                    <label class="form-label">Codigo</label>
                    <input disabled type="text" class="form-control" wire:model.defer="codigo">
                </div>

                <div class="pago-input">
                    <label class="form-label">Monto ($)</label>
                    <input disabled type="text" class="form-control" wire:model.defer="monto">
                </div>

                <div class="pago-input">
                    <label class="form-label">Monto final ($)</label>
                    <input disabled type="text" class="form-control" wire:model.defer="montoFinal">
                </div>

                <div class="pago-input">
                    <label class="form-label">Grow</label>
                    <input disabled type="text" class="form-control" wire:model.defer="grow">
                </div>

            </div>
        </div>
    </div>
    </div>
</div>
