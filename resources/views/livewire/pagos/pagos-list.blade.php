<div class="row row-cards">
    <style>
        .pagos-table-body tr:hover{
            background-color:rgba(255, 255, 255, 0.05);
            cursor:pointer;
        }

        #pagos-comprobante-container{
            position: fixed;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color:rgba(0, 0, 0, 0.074);
            padding:0;
            margin:0;
        }

        .pagos-comprobante-window{
            width: 400px;
            background-color:rgba(19, 23, 35, 0.812);
            max-width:90%:
            height: fit-content;
            max-height:95%;
            display:flex;
            flex-direction: column;
            border-radius:8px;
            padding:15px;
        }

        .pagos-comprobante-img{
            border-radius: 8px;
            max-width:100%;
            max-height: 80vh;
            margin-bottom:15px;
            object-fit: contain;
        }

        .pagos-comprobante-btn{
            width:120px;
            height: 30px;
            margin: 0 auto;
        }


    </style>

    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            <div class="ms-auto text-muted">
              <div class="ms-2 d-inline-block">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar Paciente"
                wire:model.defer="searchString" wire:keydown.enter="resetPagination">
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-vcenter card-table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Monto final</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Verificado</td>
                <th>Comprobante</th>
                <th>Codigo</th>
              </tr>
            </thead>

            <tbody class="pagos-table-body">
              @foreach($pagos as $pago)
              <tr>
                <td wire:click="abrirPago({{$pago->id}})">{{ $pago->id }}</td>
                <td wire:click="abrirPago({{$pago->id}})">${{ $pago->monto_final }}</td>
                <td wire:click="abrirPago({{$pago->id}})">{{ $pago->nombre_paciente}}</td>
                <td wire:click="abrirPago({{$pago->id}})">{{ $pago->formatted_created_at}}</td>
                <td><label class="form-check form-switch float-sm-start ms-2 mt-1" style='max-width:fit-content'>
                    <input class="form-check-input" type="checkbox"  @if($pago->verificado !== 0) checked @endif wire:click="handleVerificado({{$pago->id}})">
                    <span class="form-check-label" style="margin-left: 4px"> @if($pago->verificado === 0) No @else Si @endif</span>
                </label></td>

                <td><p style="padding-left:20px;margin:0;">
                    @if($pago->comprobante)
                    <button wire:click="mostrarComprobante('{{$pago->comprobante}}')" class="btn btn-primary" style="width:fit-content;height:fit-content;padding:0px 4px;">ver</button>
                    @else
                    <span>-</span>
                    @endif
                </p></td>

                <td wire:click="abrirPago({{$pago->id}})">{{ $pago->codigo }}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>

    @if($verComprobante)
    <div id="pagos-comprobante-container">
        <div class="pagos-comprobante-window">
            <img  src="{{asset('img/uploads/'.$comprobanteImg)}}" class="pagos-comprobante-img"/>
            <button wire:click="ocultarComprobante" class="btn btn-primary pagos-comprobante-btn">Cerrar</button>
        </div>
    </div>
    @endif

  </div>

  @push('scripts')
    <script type="text/javascript">
    </script>
  @endpush
