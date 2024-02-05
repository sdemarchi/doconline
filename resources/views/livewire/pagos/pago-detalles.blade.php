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

        .pago-comprobante-card{
            margin-top:15px;
        }

        .pago-comprobante-container{
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .pago-comprobante-img{
            max-height: 500px;
            object-fit:contain;
            border-radius: 8px;
            margin:15px 50px;
            max-width: 350px;
        }


        .pago-comprobante-noimg{
            display: flex;
            border:solid 1px rgba(255, 255, 255, 0.156);
            max-height: 300px;
            object-fit:contain;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            width:300px;
            height: 300px;
            background-color:rgba(255, 255, 255, 0.035);
            margin:15px 50px;
        }

        .pago-comprobante-buttons{
            display: flex;
            flex-direction: column;
            min-width: 250px;
        }

        .pago-comprobante-solicitar{
            margin-bottom: 15px;
        }

        .pago-comprobante-logo{
            height: 60px;
            width: 60px;
            filter:invert();
            opacity: 80%;
        }

        .pago-btn{
            margin:7px 0;
        }

        .pago-subir-comprobante{
            border:solid 1px rgba(255, 255, 255, 0.129);
            padding:5px;
            border-radius: 5px;

        }

        .pago-comprobante-head{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .pago-wsp-button{
            background-color:rgb(27, 164, 73);
            padding: 5px 5px;
            font-size: 14px;
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
    <div class="card pago-comprobante-card">
        <div class="card-body border-bottom pt-3 pb-4" >
            <h3>Comprobante</h3>

            <div class="pago-comprobante-container">

                @if($comprobante)
                    @if(pathinfo($comprobante, PATHINFO_EXTENSION) == 'pdf')
                        <div class="pdf-container">
                            <embed class="pago-comprobante-img"  style="margin-right:70px;" src="{{ asset('img/uploads/' . $comprobante) }}" type="application/pdf" width="100%" height="600px">
                        </div>
                    @else
                        <img class="pago-comprobante-img" src="{{ asset('img/uploads/' . $comprobante) }}" />
                    @endif
                @else
                    <div class="pago-comprobante-noimg">
                        <img class="pago-comprobante-logo" src="https://parspng.com/wp-content/uploads/2022/10/camerapng.parspng.com-11.png" />
                    </div>
                @endif


                <div class="pago-comprobante-buttons">

                    @if(!$comprobanteForm)
                        <a href="https://wa.me/{{ str_replace(' ', '', $pagador->telefono) }}" target="_blank" class="pago-btn btn btn-primary pago-comprobante-solicitar">Solicitar por whatsapp</a>
                        <button wire:click="switchForm" class="btn" type="submit">Adjuntar comprobante</button>
                    @else
                        <form method="POST" enctype="multipart/form-data" wire:submit.prevent="subirComprobante" >
                            <div class="pago-subir-comprobante" >
                                <input type="file" wire:model="comprobanteFile"/>
                            </div>

                            <button style="width:100%;margin-top:8px;height:fit-content;" class="btn btn-primary" type="submit">Aplicar</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>

</div>
