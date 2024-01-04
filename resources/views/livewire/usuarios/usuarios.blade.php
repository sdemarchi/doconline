<div class="row row-cards">
    <style>
        .u-fila-usuario:hover{
            background-color:#222e40;
            cursor:pointer !important;
        }
    </style>
    <div class="col-12">
      <div class="card">
        <div class="card-body border-bottom py-3">
          <div class="d-flex">
            <div class="ms-auto text-muted">
              <div class="ms-2 d-inline-block">

              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-vcenter card-table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Login</th>
                <th>E-Mail</th>
                <th>Rol</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              @foreach($usuarios as $usuario)
              <tr class="u-fila-usuario">

                <td wire:click='editar({{$usuario->id}})'>{{ $usuario->id }}</td>
                <td wire:click='editar({{$usuario->id}})'{{ $usuario->name }}</td>
                <td wire:click='editar({{$usuario->id}})'>{{ $usuario->username }}</td>
                <td wire:click='editar({{$usuario->id}})'>{{ $usuario->email }}</td>
                <td wire:click='editar({{$usuario->id}})'>{{ $usuario->role->name }}</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm btn-dark dropdown-toggle align-text-top" data-bs-boundary="viewport"
                      data-bs-toggle="dropdown">
                      Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('usuarios.edit',$usuario->id)}}">Editar</a>
                        <button class="dropdown-item" wire:click="$emit('triggerDelete',{{ $usuario->id }})">
                          Eliminar
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

  @push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', itemId => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se eliminará el Usuario',
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
