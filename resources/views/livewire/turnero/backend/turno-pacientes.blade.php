<div class="row row-cards">
    <style>
        .tp-filters-container{
            width:100%;
            display: flex;
            align-items: center;
        }
        .tp-filter{
            max-width: 160px;
            margin: 0 5px;
            height:35px;
            font-size: 14px;
            height: 30px;
            padding: 5px  10px;
        }
        .tp-search-container{
            width: 100%;
            display:flex;
            justify-content: flex-end;
        }
        .tp-header{
            display: flex;
            align-items: center;
            justify-content:space-between;
        }
        .tp-search-input{
            border-radius: 4px;
            font-size: 14px;
            height: 30px;
            padding: 5px  10px;
        }
        .tp-radio{
            display: flex;
            align-items: center;
            margin-left: 20px;
        }
        .tp-filter-button{
            border:none;
            border-radius:6px;
            font-size:14px;
            height:25px;
        }
    </style>
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom py-3">
          <div class="d-flex tp-header">
            <div class="tp-filters-container">
                <button wire:click='copiarPacientes' class="btn-primary tp-filter tp-filter-button">Copiar CSV</button>
                <select wire:change="refresh" wire:model='mesSeleccionado'  wire:model.defer='mesSeleccionado'  class="form-select tp-filter">
                    <option value="0">Todos los meses</option>
                    @for($i=0;$i<12;$i++)
                        <option value="{{ $i+1 }}">{{ $meses[$i] }}</option>
                    @endfor
                </select>
                <select wire:change="refresh" wire:model='anioSeleccionado' wire:model.defer='anioSeleccionado' class="form-select tp-filter">
                    <option value="0">Todos los años</option>
                    @for($i=$anioReferencia-5;$i<=$anioReferencia;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="form-check form-check-inline tp-filter tp-radio">
                    <input class="form-check-input" type="checkbox" wire:model='filtroPagaron' wire:change="refresh"  style="margin-right: 6px">
                    <span class="form-check-label">No pagaron</span>
                </div>
            </div>
                <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm tp-search-input" placeholder="Buscar Paciente"
                    wire:model.defer="searchString" wire:keydown.enter="resetPage">
                </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-vcenter card-table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>E-Mail</th>
                <th>Grow</th>
                <th>Fecha Emisión</th>
                <th>Turno</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              @foreach($pacientes as $paciente)
              <tr>

                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>{{ $paciente->dni }}</td>
                <td>{{ $paciente->telefono }}</td>
                <td>{{ $paciente->email }}</td>
                <td>
                    @if($paciente->grow_)
                    {{ $paciente->grow_->nombre }}
                    @else{{'-'}}
                    @endif
                </td>
                <td>@if($paciente->ultimo_turno())
                  @if($paciente->ultimo_turno()->fecha_emision)
                  {{ date_format(date_create($paciente->ultimo_turno()->fecha_emision),"d/m/Y")}}
                  @endif
                @endif
                </td>
                <td>@if($paciente->ultimo_turno())
                  <span class="badge bg-blue">{{ date_format(date_create($paciente->ultimo_turno()->fecha),"d/m/Y") }} {{ $paciente->ultimo_turno()->hora }}</span>
                  @endif
                </td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                      data-bs-toggle="dropdown">
                      Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                       <button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $paciente->id }})">
                          Eliminar
                        </button>
                    </div>
                </td>
              </tr>
              @endforeach

            </tbody>

          </table>
          {{ $pacientes->links() }}
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function () {
        @this.on('copiarPacientes', (data) => {
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

        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', itemId => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se eliminará el Paciente',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec536c',
                    cancelButtonColor: '#aaa',
                    cancelButtonText: 'cancelar',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
                    if (result.value) {
                        @this.call('eliminar',itemId)
                    }
                });
            });
        })
    </script>

  @endpush
