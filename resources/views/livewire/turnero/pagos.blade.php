<div class="page pt-5">
  <div class="container">
    <div class="text-center mb-4">
      <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
    </div>
    <div class="text-center mb-4">
      <h1>Turnos Online</h1>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2 class="text-center mb-4">Seleccioná una forma de pago</h2>
        
        <div class="row">
          @if($cuponAplicado)
            <h3 class="text-success m-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-discount-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                <path d="M9 12l2 2l4 -4"></path>
             </svg>
              Cupón de descuento aplicado por ${{ $importeDescuento }}</h3>
          @else
            <div class="col-md-6">
            <label class="form-label">Cupón de descuento</label>
            <div class="row">
              <div class="col-lg-6 col-8">
                <input type="text" class="form-control" wire:model.defer="cupon">
                @error('cupon')
                <div class="text-danger">{{ $message }}</div>
                @enderror

              </div>
              <button class="btn btn-primary col-lg-3 col-4" wire:click="aplicarCupon">Aplicar Cupón</button>
            </div>

          </div>
          @endif
        </div>
       
        <div class="row">
          <div class="col-md-6">
            <div class="card card-md mx-2 my-4">
              <div class="card-body text-center">
                <div class="text-uppercase text-muted font-weight-medium">Transferencia</div>
                <div class="display-5 fw-bold my-3">${{ $precioTransf }}</div>
                <div style="height:30px">
                  Desde cualquier banco físico o virtual<br />
                </div>
                <div class="mt-4">
                  <a class="btn btn-green" href="{{ route('turnero.pagar','1') }}">Seleccionar</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-md mx-2 my-4">
              <div class="card-body text-center">
                <div class="text-uppercase text-muted font-weight-medium">Mercado Pago</div>
                <div class="display-5 fw-bold my-3">${{ $precioMP }}</div>
                <div style="height:30px">
                  Hasta 3 cuotas<br />
                  Con todas las tarjetas de crédito
                </div>
                <div class="mt-4">
                  <a class="btn btn-green" href="{{route('turnero.pagar','2')}}">Seleccionar</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('turnero.confirmar') }}">Atrás</a>
        </div>

      </div>
    </div>

  </div>
</div>