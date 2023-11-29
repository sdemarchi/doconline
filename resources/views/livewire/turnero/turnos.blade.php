<div class="page pt-5">
    <div class="container">
      <div class="text-center mb-4">
        <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300"/></a>
      </div>
      <div class="text-center mb-4">
        <h1>Turnos Online</h1>
      </div>
      <div class="card card-md">
        <div class="card-body">
            <h2 class="text-center mb-4">Nuevo Turno</h1>
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <label class="form-label">Seleccioná Prestador</label>
                @foreach($prestadores as $prestador)
                  <button class="btn-pill btn-primary py-1 px-4" wire:click="prestadorSelect({{ $prestador->id }})">
                    {{ $prestador->nombre }}</button>
                @endforeach
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div @if(!$prestadorId) style="display:none" @endif class="mt-2">
                        <h4 class="mt-4 mb-3">Seleccioná un Día (en verde los disponibles)</h4>
                        <button class ="item-calendario control-calendario" wire:click="mesAnterior">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
                        </button>
                        <button class ="item-calendario titulo-calendario">{{ $mesTexto }} {{ $anioActual }}</button>
                        <button class ="item-calendario control-calendario" wire:click="mesSiguiente">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>
                        </button>
                       <div>
                        <button class="encabez-calendario">dom.</button>
                        <button class="encabez-calendario">lun.</button>
                        <button class="encabez-calendario">mar.</button>
                        <button class="encabez-calendario">mie.</button>
                        <button class="encabez-calendario">jue.</button>
                        <button class="encabez-calendario">vie.</button>
                        <button class="encabez-calendario">sáb.</button>

                       </div>
                        <?php $i = 0; ?>
                        @foreach($calendario as $dia)
                          <?php $i++; ?>

                            <button class="item-calendario {{$dia['inactivo']}} {{$dia['enmes']}} {{$dia['turnos']}}"
                            wire:click="fechaSelect('{{ $dia['fecha']}}', '{{$dia['inactivo']}}')">
                              {{ $dia['dia'] }}</button>

                          <?php
                            if($i == 7){
                              echo '<br/>';
                              $i = 0;
                            }
                          ?>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-6">
                  <div @if(!$fechaSeleccionada) style="display:none" @endif class="mt-2">
                    <h4 class="mt-4 mb-3">Seleccioná un Turno</h4>
                    @foreach($turnos as $turno)
                    <button class="turno" wire:click="turnoSelect({{ $turno['id']}})">
                      {{ $turno['detalle'] }}</button><br/>
                    @endforeach
                  </div>


                </div>
            </div>
            <div class="form-footer">
              <a class="btn btn-secondary" href="{{ route('turnero.panel') }}">Atrás</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
