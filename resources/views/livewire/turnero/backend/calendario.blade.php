<div class="card card-md ">
  <div class="card-body ">
    <div class="row mt-3">
      <!--<div class="col-lg-4 mx-auto">
        <h4>Importación de Turnos desde Archivos</h4>
        <form wire:submit.prevent="guardarArchivoTurnos">

          <div class="form-group">

            <input type="file" wire:model="fileTurnos">
            <div wire:loading wire:target="fileTurnos">Cargando Archivo...</div>

            <div wire:loading.remove><button type="submit" class="btn btn-primary mt-2 float-start">Importar
                Turnos</button></div>
            <div><a href="{{ route('turnos.create') }}" class="btn btn-primary mt-2 ms-2 float-start">Nuevo
                Turno</a>
            </div>


          </div>


        </form>
      </div>-->


    </div>
    <div class="row mt-3">

      <div class="mt-2 col-lg-4 mx-auto">

        <button class="item-calendario control-calendario" wire:click="mesAnterior">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="15 6 9 12 15 18" />
          </svg>
        </button>

        <button class="item-calendario titulo-calendario">{{ $mesTexto }} {{ $anioActual }}</button>
        <button class="item-calendario control-calendario" wire:click="mesSiguiente">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="9 6 15 12 9 18" />
          </svg>
        </button>
        <br />

        <button class="encabez-calendario">dom.</button>
        <button class="encabez-calendario">lun.</button>
        <button class="encabez-calendario">mar.</button>
        <button class="encabez-calendario">mie.</button>
        <button class="encabez-calendario">jue.</button>
        <button class="encabez-calendario">vie.</button>
        <button class="encabez-calendario">sáb.</button>

        <br />
        <?php $i = 0; ?>

        @foreach($calendario as $dia)
        <?php $i++; ?>
        <button class="item-calendario {{$dia['enmes']}} {{$dia['turnos']}}"
          wire:click="fechaSelect('{{ $dia['fecha']}}')">
          {{ $dia['dia'] }}</button>
        <?php
                          if($i == 7){
                            echo '<br/>';
                            $i = 0;
                          }
                        ?>
        @endforeach
      </div>

    <!----  TABLA DE TURNOS CORRESPONDIENTES AL DIA SELECCIONADO -------->

      <div class="row mt-2 turnos-container">
        <div @if(!$fechaSeleccionada) style="display:none" @endif class="mt-2">
          <h4 class="mt-4 mb-3 turnos-titulo">Turnos para el {{ $fechaSelFormateada }} </h4>

          <div class="table-responsive turnos-table">
            <table class="table table-vcenter card-table">

              <thead>
                <tr>
                    <th>Patologia</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Atendido</th>
                    <th>Cancelar / Editar</th>
                    <th>Comentarios</th>
                    <th>Cupón</th>
                    <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach($turnos as $turno)
                <tr class="table-filas">
                    @foreach($turno['patologias'] as $index => $item)

                    <td class="turno-patologia" style="max-width: 120px;padding: 8px;">  @if($item->patologia){{ $item->patologia->dolencia}}@endif </td>

                    @endforeach

                    <td class="turno-hora">{{ $turno['hora'] }}</td>

                    <td class="turno-paciente">
                        @if($turno['paciente'])
                            <a href="{{route('pacientes.turnero.edit',$turno['pacienteId'])}}">{{ $turno['paciente'] }}</a>
                            <a href="https://wa.me/{{ $turno['telefono'] }}" target="_blank">
                            <img class="ms-2" src="{{ asset('img/logo-whatsapp.png')}}" width="25" /></a>
                        @endif
                        @if($turno['comprobante_pago'])
                        @if ($turno['comprobante_pago'] == "mercadopago")
                            <span class="badge bg-azure">MP</span>
                        @else
                            <a href="{{ url('img/uploads/' . $turno['comprobante_pago']) }}" target="_blank"><img src="{{ asset('img/icon-decl.png')}}" width="25"/></a>
                        @endif
                        @endif
                        @if($turno['fichaId'])
                            <a class="btn btn-ghost-light btn-icon" href="{{route('pacientes.edit',$turno['fichaId'])}}"
                            data-toggle="tooltip" data-placement="right" title="Ficha del Paciente">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="3" width="14" height="18" rx="2"></rect>
                                <line x1="9" y1="7" x2="15" y2="7"></line>
                                <line x1="9" y1="11" x2="15" y2="11"></line>
                                <line x1="9" y1="15" x2="13" y2="15"></line>
                            </svg>
                            </a>
                            <button class="btn btn-ghost-light btn-icon" wire:click="mailFormulario({{ $turno['fichaId'] }})"
                            data-toggle="tooltip" data-placement="right" title="Enviar Ficha">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <polyline points="3 7 12 13 21 7"></polyline>
                            </svg>
                            </button>
                        @endif
                    </td>

                    <td class="turno-atendido">
                        @if($turno['paciente'])
                        @if ($turno['atendido'])
                        <span class="btn badge bg-success me-1" wire:click="noAtendido('{{ $turno['id'] }}')"></span>Sí
                        @else
                        <span class="btn badge bg-danger me-1" wire:click="atendido('{{ $turno['id'] }}')"></span>No
                        @endif
                        @endif
                    </td>

                    <td class="turno-cancelar-editar">
                        @if(!$turno['asignado'])
                            <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerDelete',{{ $turno['id'] }})"
                            data-toggle="tooltip" data-placement="right" title="Eliminar Turno">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="4" y1="7" x2="20" y2="7" />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            </button>
                        @else
                            <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerCancel',{{ $turno['id'] }})"
                            data-toggle="tooltip" data-placement="right" title="Cancelar Turno">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user-off -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" />
                                <line x1="3" y1="3" x2="21" y2="21" />
                            </svg>
                            </button>
                        @endif

                        <a class="btn btn-ghost-light btn-icon" href="{{route('turnos.edit',$turno['id']) }}"
                        data-toggle="tooltip" data-placement="right" title="Editar Turno">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                        </a>
                    </td>

                    <td class="turno-comentarios">
                        <textarea class="form-control" rows="1"
                        id="com-{{$turno['id']}}">{{$turno['comentarios']}}</textarea>
                    </td>

                    <td>
                       <span style="font-size:12px"> {{$turno['cupon']}} </span>
                    </td>

                    <td class="turno-guardar">
                        <button class="btn btn-ghost-light btn-icon"
                        wire:click="$emit('guardarComentario',{{ $turno['id'] }})" data-toggle="tooltip"
                        data-placement="right" title="Guardar Comentario">
                        <!-- Download SVG icon from http://tabler-icons.io/i/user-off -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                            <circle cx="12" cy="14" r="2"></circle>
                            <polyline points="14 4 14 8 8 8 8 4"></polyline>
                        </svg>
                        </button>
                    </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


        </div>
      </div>


    </div>
  </div>
</div>

@push('scripts')


<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerDelete', itemId => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se eliminará el Turno',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'cancelar',
                  confirmButtonText: 'Eliminar!'
              }).then((result) => {
                  if (result.value) {

                      @this.call('eliminarTurno',itemId)

                  }
              });
          });
      })
      document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerCancel', itemId => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se cancelará el Turno',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'No cancelar Turno',
                  confirmButtonText: 'Cancelar Turno!'
              }).then((result) => {
          //if user clicks on delete
                  if (result.value) {

                      @this.call('cancelarTurno',itemId)

                  }
              });
          });
      })
      document.addEventListener('DOMContentLoaded', function () {
          @this.on('guardarComentario', itemId => {
            comentario = document.getElementById('com-' + itemId).value;
            @this.call('guardarComentario', itemId, comentario)
          });
        })

</script>

@endpush
