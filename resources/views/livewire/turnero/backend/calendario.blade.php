<div>
    <style>
        .calendario-container{
            width:100%;
            padding: 15px auto;
            margin-bottom: 15px;
        }

        .calendario-content{
            margin: 0 auto;
            width: fit-content;
        }

        .turnos-table::-webkit-scrollbar-track {
            background-color: rgba(128, 128, 128, 0);
        }

        #calendario-table{
            min-width:max-content;
            margin-bottom:25px !important;
        }

        #calendario-loader{
            display:block;
            z-index:200;
            !important;
            min-width:100%;
            display:none;
            align-items:center;
            justify-content:center;
            height:120px;
        }

        .calendario-mensaje{
            width: 100%;
            text-align: center;
            color:rgba(255, 255, 255, 0.634);
        }

        .calendario-copiar-button{
            margin-left:5px;
            border:none;
            border-radius:4px;
        }

        .calendario-icon{
            height: 25px;
        }

    </style>

    <div class="card card-md calendario-container">
        <div class="card-body">
            <div class="calendario-content">
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
                    <button onClick="calendarioLoading()" class="item-calendario {{$dia['enmes']}} {{$dia['turnos']}}" wire:click="fechaSelect('{{ $dia['fecha']}}')"> {{ $dia['dia'] }}</button>
                    <?php if($i == 7){echo '<br/>';$i = 0;}?>
                @endforeach
            </div>
        </div>
    </div>

    <!----  TABLA DE TURNOS CORRESPONDIENTES AL DIA SELECCIONADO -------->

    <div class="card calendario-table-container">
        <div class="card-body">
            <div class="turnos-container">
                <h4 class="mt-2 mb-3 turnos-titulo">{{ $fechaSelFormateada }} <button @if(!$fechaSeleccionada) style="display:none" @endif wire:click='copiarTurnos' class="calendario-copiar-button">Copiar</button></h4>

                <div id="calendario-loader">
                    @include('components.loader')
                </div>

                <div  class="table-responsive turnos-table">
                    <table id="calendario-table" class="table table-vcenter card-table">
                        @if($fechaSeleccionada && count($turnos) == 0)
                            <div class="calendario-mensaje">No hay turnos para la fecha seleccionada</div>
                        @endif

                        @if(!$fechaSeleccionada && count($turnos) == 0)
                            <div class="calendario-mensaje mt-3">Selecciona un día en el calendario</div>
                        @endif

                        @if(count($turnos) > 0)

                        <thead>
                            <tr>
                                <th>Patologia</th>
                                <th>Hora</th>
                                <th>Paciente</th>
                                <th></th>
                                <th>Pago verif.</th>
                                <th class="text-center">Atend</th>
                                <th class="text-center">Pedi captura</th>
                                <th class="text-center">Captura</th>
                                <th class="text-center">Canc / Edit</th>
                                <th>Comentarios</th>
                                <th>Cupón</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($turnos as $turno)
                            <tr class="table-filas">
                                <td class="turno-patologia" style="max-width: 120px;padding:8px;!important;">
                                    @if($turno['paciente'] && $turno['patologias'])
                                        @foreach($turno['patologias'] as $index => $item)

                                        @if(isset($item->patologia))<p style="margin-bottom:5px">{{$item->patologia->dolencia}}</p>@endif

                                        @endforeach
                                    @endif
                                </td>

                                <td class="turno-hora">{{ $turno['hora'] }}</td>

                                <td class="turno-paciente">
                                    @if($turno['paciente'])
                                        <a style="margin-right:10px;" href="{{route('pacientes.turnero.edit',$turno['pacienteId'])}}">{{ $turno['paciente'] }}</a>
                                    @endif
                                </td>

                                <td>
                                    @if($turno['paciente'])
                                        <a style="max-width:fit-content;padding:7px 0px;" class="btn btn-ghost-light btn-icon" href="https://wa.me/{{ $turno['telefono'] }}" target="_blank" title="Hablar por Whatsapp">
                                        <img src="{{ asset('img/logo-wsp-b.png')}}" height="19" style="opacity:60%"/></a>

                                        <button class="btn btn-ghost-light" onClick="copyTextToClipboard({{ $turno['telefono'] }});" style="margin:0 !important;padding:7px !important;opacity:70%;" wire:click="notificacion('Celular copiado al portapapeles')" title="Copiar celular"><img src="{{ asset('img/icon-cel.png')}}" width="19" height="21"/></button>
                                    @endif

                                    @if($turno['comprobante_pago'])
                                        @if ($turno['comprobante_pago'] == "mercadopago")
                                            <span class="badge bg-azure">MP</span>
                                        @else
                                            <a title="Ver comprobante de pago" class="btn btn-ghost-light btn-icon" style="max-width:fit-content;padding:7px 0px;" href="{{ url('img/uploads/' . $turno['comprobante_pago']) }}" target="_blank"><img src="{{ asset('img/comprobante.png')}}" width="13"/></a>
                                        @endif
                                    @endif

                                    @if($turno['fichaId'])
                                        <a class="ficha-button btn btn-ghost-light btn-icon" href="{{route('pacientes.edit',$turno['fichaId'])}}" data-toggle="tooltip" data-placement="right" title="Ficha del Paciente">
                                            <img class="icon calendario-icon" src={{asset('svg/ficha.svg')}} >
                                        </a>

                                        <button class="email-button btn btn-ghost-light btn-icon" wire:click="mailFormulario({{ $turno['fichaId'] }})" data-toggle="tooltip" data-placement="right" title="Enviar Ficha">
                                            <img class="icon calendario-icon" src={{asset('svg/email.svg')}} >
                                        </button>
                                    @endif
                                </td>

                                <td>
                                    @if($turno['pago'] && is_object($turno['pago']) && $turno['pago']['verificado'])
                                           <!-- <label style="margin:0 auto;" class="form-check form-switch float-sm-start ms-2 mt-1" style='max-width:fit-content'>
                                        <input class="form-check-input" type="checkbox" @if($turno['pago']['verificado']) checked @endif ">
                                        </label> -->
                                        <p class="text-center">Si</p>
                                    @else
                                        <p class="text-center">-</p>
                                    @endif
                                </td>

                                <td class="turno-atendido" style="text-align:center;">
                                    @if($turno['paciente'])
                                        @if ($turno['atendido'])
                                            <span class="btn badge bg-success me-1" wire:click="noAtendido('{{ $turno['id'] }}')"></span>Sí
                                        @else
                                            <span class="btn badge bg-danger me-1" wire:click="atendido('{{ $turno['id'] }}')"></span>No
                                        @endif
                                    @endif
                                </td>

                                <td class="turno-pedi-captura" style="text-align:center;">
                                    @if($turno['paciente'])
                                        @if ($turno['pedi_captura'])
                                            <span class="btn badge bg-success me-1" wire:click="noPediCaptura('{{ $turno['id'] }}')"></span>Sí
                                        @else
                                            <span class="btn badge bg-danger me-1" wire:click="pediCaptura('{{ $turno['id'] }}')"></span>No
                                        @endif
                                    @endif
                                </td>

                                <td class="turno-mando-captura" style="text-align:center;">
                                    @if($turno['paciente'])
                                        @if ($turno['mando_captura'])
                                            <span class="btn badge bg-success me-1" wire:click="noMandoCaptura('{{ $turno['id'] }}')"></span>Sí
                                        @else
                                            <span class="btn badge bg-danger me-1" wire:click="mandoCaptura('{{ $turno['id'] }}')"></span>No
                                        @endif
                                    @endif
                                </td>

                                <td  style='text-align:center' class="turno-cancelar-editar">
                                    @if(!$turno['asignado'])
                                        <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerDelete',{{ $turno['id'] }})"
                                        data-toggle="tooltip" data-placement="right" title="Eliminar Turno">
                                            <img class="icon calendario-icon" src={{asset('svg/delete.svg')}} >
                                        </button>
                                    @else
                                        <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerCancel',{{ $turno['id'] }})" data-toggle="tooltip" data-placement="right" title="Cancelar Turno">
                                            <img class="icon calendario-icon" src={{asset('svg/cancel.svg')}} >
                                        </button>
                                    @endif

                                    <a class="btn btn-ghost-light btn-icon" href="{{route('turnos.edit',$turno['id']) }}" data-toggle="tooltip" data-placement="right" title="Editar Turno">
                                        <img class="icon calendario-icon" src={{asset('svg/edit.svg')}} >
                                    </a>
                                </td>

                                <td class="turno-comentarios">
                                    <div style="display:flex;flex-direction:row;max-width:240px;">
                                        <textarea style="height:100%;" class="form-control" id="com-{{$turno['id']}}">{{$turno['comentarios']}}</textarea>

                                        <button class="btn btn-ghost-light btn-icon" wire:click="$emit('guardarComentario',{{ $turno['id'] }})" data-toggle="tooltip" data-placement="right" title="Guardar Comentario">
                                            <img class="icon calendario-icon" src={{asset('svg/save.svg')}} >
                                        </button>
                                    </div>
                                </td>

                                <td>
                                    <span style="font-size:12px"> {{$turno['cupon']}} </span>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
        @this.on('copiarTurnos', (data) => {
            var elemento = document.createElement('div');
            elemento.innerHTML = data.html;
            document.body.appendChild(elemento);

            var seleccion = window.getSelection();
            var rango = document.createRange();
            rango.selectNodeContents(elemento);
            seleccion.removeAllRanges();
            seleccion.addRange(rango);

            document.execCommand("copy");
            document.body.removeChild(elemento);
        });
    })

    function copyTextToClipboard(valor) {
        const textArea = document.createElement("textarea");
        textArea.value = valor;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy");
        document.body.removeChild(textArea);
    };

    function calendarioLoading(){
            let loader = document.querySelector("#calendario-loader");
            let calendarioTable = document.querySelector("#calendario-table");
            let calendarioMensaje = document.querySelector("#calendario-mensaje");

            loader.style.display='flex';
            calendarioTable.style.visibility='hidden';
            calendarioMensaje.style.display='none';
        };


    document.addEventListener('DOMContentLoaded', function () {
        let loader = document.querySelector("#calendario-loader");
        let calendarioTable = document.querySelector("#calendario-table");
        let calendarioMsj = document.querySelector("#calendario-mensaje");

        Livewire.on('calendario-loaded', () => {
          console.log('loaded');
          loader.style.display='none';
          calendarioTable.style.visibility='visible';
        });

     })

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
