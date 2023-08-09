<div class="page pt-5">
  <div class="container py-4">
    <div class="text-center mb-4">
      <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
    </div>
    <div class="text-center mb-4">
      <h1>Turnos Online</h1>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2>Felicitaciones</h2>
        <h2>Tu turno fue confirmado</h2>
        <p><strong>Lugar:</strong> Whatsapp</p>
        <p><strong>Turno:</strong> {{ $detalle }}</strong></p>
        <p>Recibirás un mail con los datos de tu formulario. Revisalos que estén en orden</p>
        <p>Cualquier modificación se podrá realizar durante la consulta médica</p>
        @if(!$turno->comprobante_pago)
        <div class="bg-green-lt p-2">Para confirmar tu turno envianos el comprobante por Whatsapp antes de la fecha del
          mismo</div>
        @endif

        <div class="form-footer">
          <a class="btn btn-secondary" onclick="history.back()">Atrás</a>
          @if($formularioIncompleto)
          <a class="btn btn-primary" href="{{ route('home') }}">Siguiente</a>
          @else
          <a class="btn btn-primary float-end" href="{{ route('turnero.panel') }}">Siguiente</a>
          @endif

        </div>
      </div>

    </div>

  </div>
</div>