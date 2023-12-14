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
        #loader-contacto{
            display:flex;
            z-index:200 !important;
            display:none;
            width:fit-content;
            margin: 0 auto;
            transform: translate(50px,-50px)
        }

        #loader-pacientes{
            display:block;
            z-index:200 !important;
            min-width:100%;
            display:none;
            align-items:center;
            justify-content:center;
            height:120px;
            width:100%;
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
                <select class="form-select" wire:model="mesActual" wire:change="refresh" wire:click="refresh" onChange="contactoLoading()">

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
              <table  id="table-contacto" class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th>Modo de contacto</th>
                    <th>N° Pacientes / Mes</th>
                    <th>Pagaron</th>
                    <th>No pagaron</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($contactoPacientes as $contacto_)
                        <tr class='grow-button' wire:click="seleccionarContacto({{ $contacto_['idcontacto'] }},'{{ $contacto_['nombre']}}')">
                            <td>{{ $contacto_['nombre'] }}</td>
                            <td>{{ $contacto_['pacientes'] }}</td>
                            <td>{{ $contacto_['pagaron'] }}</td>
                            <td>{{ $contacto_['no-pagaron'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
              <div id="loader-contacto">
                @include('components.loader')
               </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row row-cards grow-card">
      <div class="col-12" style="margin-top:0 !important">
        <div class="card">
          <div class="card-body border-bottom pb-4">

            <div class="row">
                <div>
                    @if(!$contactoSeleccionadoNombre)
                        <h3 style="display:inline">Pacientes</h3>
                    @endif

                    @if($contactoSeleccionadoNombre)
                        <h3 style="display:inline">{{$contactoSeleccionadoNombre}}</h3>
                    @endif
                </div>
            </div>

          </div>
          <div id="table-pacientes" class="table-responsive">
            <table class="table table-vcenter card-table">
              <thead>
                <tr>
                  <th>Paciente</th>
                  <th>Email</th>
                  <th>Celular</th>
                  <th>Pago</th>
                </tr>
              </thead>
              <tbody>

                @foreach($pacientesContacto as &$paciente)
                    <tr class='grow-button' wire:click='abrirFicha({{$paciente['dni']}})'>
                        <td>{{ $paciente['nom_ape']}}</td>
                        <td>{{ $paciente['email'] }}</td>
                        <td>{{ $paciente['celular'] }}</td>
                        <td>{{ $paciente['pago'] }}</td>
                    </tr>
                @endforeach

              </tbody>
            </table>

            @if($contactoSeleccionado == 0)
                <p id="grow-seleccion-mensaje">No has seleccionado ningun elemento.</p>
            @endif

          </div>

          <div id="loader-pacientes">
            Cargando...
        </div>

        </div>
      </div>
    </div>
  </div>
  <script>

    function contactoLoading(){
            let loader = document.querySelector("#loader-contacto");
            let contactoTable = document.querySelector("#table-contacto");

            loader.style.display='flex';
            contactoTable.style.visibility='hidden';
        };


    document.addEventListener('DOMContentLoaded', function () {
        let loader = document.querySelector("#loader-contacto");
        let contactoTable = document.querySelector("#table-contacto");

        Livewire.on('pacientes-contacto-loaded', () => {
          loader.style.display='none';
          calendarioTable.style.visibility='visible';
        });

     })
</script>
