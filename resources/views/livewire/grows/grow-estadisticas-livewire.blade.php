<div class="grow-estadisticas-container">

    <style>
        .grow-estadisticas-container{
            min-width: 95vw;
            display:flex;
            flex-direction:row;
            flex-wrap:wrap;
            margin-bottom:50px;
            max-width:100vw;
        }

        .grow-card{
            margin: 0 10px;
        }

        .grow-button{
            cursor:pointer;
        }

        .grow-button:hover{
            background-color:rgba(255, 255, 255, 0.048) !important;
        }

        #grow-seleccion-mensaje{
            color:rgb(182, 182, 182);
            text-align: center;
            margin-top:30px;
        }

        .grow-estadisticas-detalles{
            background-color:rgb(83, 83, 83);
            color:rgb(201, 201, 201);
            margin: 0 8px;
            border-radius: 4px;
            border: none;
            font-size:13px;
            box-shadow: 3px 3px 3px 1px rgba(0, 0, 0, 0.074);
            font-weight: 500;
            text-decoration: none;
            padding: 2px 4px;
        }
        .grow-estadisticas-detalles:hover{
            background-color:rgb(93, 93, 93);
            text-decoration: none;
            color:rgb(201, 201, 201);
        }

        #loader-grows{
            display:flex;
            z-index:200 !important;
            display:none;
            width:fit-content;
            margin: 0 auto;
            transform: translate(50px,-50px)
        }

        .table-total{
            font-weight: 600;
            background-color:rgba(224, 224, 224, 0.041);
            border-radius: 8px;
            overflow: hidden;
        }
    </style>

    <div class="row row-cards grow-card" >
      <div class="col-12"  style="margin-top:0 !important">
        <div class="card">
          <div class="card-body border-bottom pb-4">
            <div class="row">
              <div class="col">
                <h3>Pacientes durante el mes</h3>
              </div>
              <div class="col-md-2 col-sm-3 mt-1">
                <select class="form-select" wire:model="mesActual"  wire:change="refresh" wire:click="refresh" onChange="growsLoading()">

                  @for($i=0;$i<12;$i++)
                    <option wire:change="refresh" value="{{ $i+1 }}">{{ $meses[$i] }}</option>
                  @endfor

                </select>
              </div>
              <div class="col-md-2 col-sm-3 mt-1">
                <select class="form-select" wire:model="anioActual" wire:change="refresh">

                  @for($i=$anioReferencia-10;$i<=$anioReferencia;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor

                </select>
              </div>
            </div>


            <div class="table-responsive">
              <table id="table-grows" class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th>Grow</th>
                    <th>N° Pacientes / Mes</th>
                    <th>Pagaron</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($growsPacientes['grows'] as $grow)
                        <tr class='grow-button' wire:click="seleccionarGrow({{ $grow['growid'] }},'{{ $grow['nombre']}}')">
                            <td>{{ $grow['nombre'] }}</td>
                            <td>{{ $grow['pacientes'] }}</td>
                            <td>{{ $grow['pagaron'] }}</td>
                        </tr>
                    @endforeach


                    <tr class='grow-button table-total'>
                        <td>Total:</td>
                        <td>{{ $growsPacientes['numPacientes'] }}</td>
                        <td>{{ $growsPacientes['pagaronMes'] }}</td>
                    </tr>

                </tbody>
              </table>
              <div id="loader-grows">
                @include('components.loader')
               </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cards grow-card">
      <div class="col-12"  style="margin-top:0 !important">
        <div class="card">
          <div class="card-body border-bottom pb-4">

            <div class="row">
                <div>
                    @if(!$growSeleccionadoNombre)
                        <h3 style="display:inline">Grow</h3>
                    @endif

                    @if($growSeleccionadoNombre)
                        <h3 style="display:inline">{{$growSeleccionadoNombre}}</h3>
                    @endif

                    @if($growSeleccionado)
                        <a href="{{route('grows.edit',$growSeleccionado)}}" class="grow-estadisticas-detalles">Ver detalles</a>
                    @endif
                </div>
            </div>

          </div>
          <div class="table-responsive">
            <table class="table table-vcenter card-table">
              <thead>
                <tr>
                  <th>Paciente</th>
                  <th>Pago</th>
                </tr>
              </thead>
              <tbody>

                @foreach($pacientesGrow as &$paciente)
                    <tr class='grow-button' wire:click='abrirFicha({{$paciente['dni']}})'>
                    <td>{{ $paciente['nombre']}}</td>
                    <td>
                        {{ $paciente['pago'] }}
                    </td>
                    </tr>
                @endforeach

              </tbody>
            </table>

            @if($growSeleccionado == 0)
                <p id="grow-seleccion-mensaje">No has seleccionado ningun elemento.</p>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
  <script>

    function growsLoading(){
            let loader = document.querySelector("#loader-grows");
            let contactoTable = document.querySelector("#table-grows");

            loader.style.display='flex';
            contactoTable.style.visibility='hidden';
        };


    document.addEventListener('DOMContentLoaded', function () {
        let loader = document.querySelector("#loader-grows");
        let contactoTable = document.querySelector("#table-grows");

        Livewire.on('grows-loaded', () => {
          loader.style.display='none';
          calendarioTable.style.visibility='visible';
        });

     })

</script>

