<div class="page pt-5">
  <?php
    // SDK de Mercado Pago
    require base_path('vendor/autoload.php');
    // Agrega credenciales
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Turno de Consulta';
    $item->quantity = 1;
    $item->unit_price = $precioMP;
    $preference->items = array($item);
    $preference->back_urls = array (
      'success' => route('turnero.mp-success'),
      'failure' => route('turnero.mp-failure'),
      'pending' => route('turnero.mp-pending')
    );
    $preference->auto_return = "approved";
    $preference->save();
  ?>


  <div class="container-tight container-login py-4">
    <div class="text-center mb-4">
      <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
    </div>
    <div class="text-center mb-4">
      <h1>Turnos Online</h1>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Confirmar el Turno</h2>
        @if($medioPago == 1)
        <h4 class="text-center">CBU {{ $CBU }}</h4>
        <h4 class="text-center">ALIAS {{ $Alias }}</h4>
        <h3 class="mt-4 mb-3">Total a pagar: ${{$precioTransf}}</h3>
        <div class="mb-3">
          <h5>Adjuntá tu comprobante de pago para confirmar tu turno</h5>
        </div>
        <form wire:submit.prevent="subirComprobante">

          <div class="form-group">
            <input type="file" wire:model="comprobante">
          </div>
          <!--<div wire:loading wire:target="comprobante">Cargando...</div>
          <div wire:loading.remove><button type="submit" class="btn btn-primary mt-2">Enviar Comprobante</button></div>-->
        </form>

        @elseif($medioPago == 2)
        <h3>Total a pagar: ${{$precioMP}}</h3>
        
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <div class="cho-container"></div>
        <script>
          const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-AR'
          });

          mp.checkout({
            preference: {
              id: '{{ $preference->id }}'
            },
            render: {
              container: '.cho-container',
              label: 'Pagar',
            }
          });
        </script>
        @elseif($medioPago == 3)
          <h2>{{ $mensajePago }}</h2>
        @endif
        
        <div class="form-footer">
          <a href="{{ route('turnero.pagos') }}" class="btn btn-secondary">Atrás </a>
          <button class="btn btn-primary float-end" wire:click="confirmarTurno">Confirmar Turno</button>

        </div>
      </div>
    </div>

  </div>
</div>