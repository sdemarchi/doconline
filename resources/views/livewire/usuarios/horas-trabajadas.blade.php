<div>
  <div class="row row-cards">
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom pt-3 pb-4">
          <div class="row">
            <div class="col">
              <h3>Horas trabajadas durante el mes</h3>
            </div>
            <div class="col-md-2 col-sm-3 mt-1">
              <select class="form-select" wire:model="mesActual" wire:click="refresh">
                @for($i=0;$i<12;$i++)
                  <option value="{{ $i+1 }}">{{ $meses[$i] }}</option>
                @endfor
              </select>
              </div>
            <div class="col-md-2 col-sm-3 mt-1">
              <select class="form-select" wire:model="anioActual" wire:click="refresh">
                @for($i=$anioReferencia-10;$i<=$anioReferencia;$i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>


          <div class="table-responsive">
            <table class="table table-vcenter card-table">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Horas Trabajadas</th>

                </tr>
              </thead>
              <tbody>

                @foreach($usuariosHoras as $usuario)
                <tr>

                  <td>{{ $usuario['nombre'] }}</td>
                  <td>{{ $usuario['horas'] }}</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                        data-bs-toggle="dropdown">
                        Acciones
                      </button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <button class="dropdown-item" wire:click="liquidarMes('{{ $usuario['id'] }}')">
                          Liquidar Mes
                        </button>

                      </div>
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
  <div class="row row-cards mt-2">
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom pt-3 pb-4">

          <div class="row">
            <div class="col">
              <h3>Registros de ingreso y egreso</h3>
            </div>
            <div class="col-md-4 col-sm-5 mt-1">
              <select class="form-select" wire:model="userId" wire:click="resetPagination">
                <option value="0">Todos los Usuarios</option>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
        <div class="table-responsive">
          <table class="table table-vcenter card-table">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Horas del Día</th>
                <th>Liquidado</th>
                <th>Comentarios</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              @foreach($horas as $hora)
              <tr>

                <td>{{ $hora->usuario->name }}</td>
                <td>{{ date_format(date_create($hora->inicio),"d-m-Y H:i") }}
                  <a class="btn btn-ghost-light btn-icon" href="{{route('usuarios.ingreso.edit',$hora->id)}}"
                    data-toggle="tooltip" data-placement="right" title="Editar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                      <path d="M16 5l3 3"></path>
                  </svg>
                  </a>
                </td>
                <td>
                  @if($hora->fin)
                  {{ date_format(date_create($hora->fin),"d-m-Y H:i") }}
                  <a class="btn btn-ghost-light btn-icon" href="{{route('usuarios.egreso.edit',$hora->id)}}"
                    data-toggle="tooltip" data-placement="right" title="Editar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                      <path d="M16 5l3 3"></path>
                  </svg>
                  </a>
                  @endif
                </td>
                <td>
                  @if($hora->fin)
                  {{ $hora->getHorasTrabajadas()}}
                  @endif
                </td>
                <td>
                  @if($hora->liquidado)
                  <span class="badge bg-success">Sí</span>
                  @else
                  <span class="badge bg-danger">No</span>
                  @endif
                </td>
                <td>{{ $hora->comentarios }}</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                      data-bs-toggle="dropdown">
                      Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      @if($hora->liquidado)
                      <button class="dropdown-item" wire:click="noLiquidado('{{ $hora->id }}')">
                        No Liquidado
                      </button>
                      @else
                      <button class="dropdown-item" wire:click="liquidado('{{ $hora->id }}')">
                        Liquidado
                      </button>
                      @endif

                    </div>
                </td>
              </tr>
              @endforeach

            </tbody>

          </table>
          {{ $horas->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
