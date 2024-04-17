<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th width="30"></th>
                            <th width="30"></th>
                            <th width="50">N°</th>
                            <th>Producto</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan=3><button class="btn btn-outline-primary" wire:click="agregarItem">Agregar</button></td>
                            <td>
                                <textarea class="form-control" placeholder="Agregar producto" rows="1" wire:model.defer="productoAgregar"></textarea>
                                @error('productoAgregar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        @foreach($productos as $index => $producto)
                        <tr>

                            <td id="boton-eliminar" class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon p-0" wire:click="$emit('triggerDelete',{{ $producto->idproducto }})">
                                    <img src="{{ asset('svg/delete.svg') }}" alt="delete">
                                </button>
                            </td>

                            <td id="boton-guardar" class="pe-2 p-0">
                                <button class="btn btn-ghost-light btn-icon p-0" wire:click="guardarItem({{$index}})">
                                    <img src="{{ asset('svg/save.svg') }}" alt="save">
                                </button>
                            </td>

                            <td id="id-producto">{{ $producto->idproducto }}</td>
                            <td id="nombre-producto"><textarea class="form-control" rows="1" wire:model.defer="productos.{{ $index }}.producto"></textarea></td>
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
                    text: 'Se eliminará el Producto',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec536c',
                    cancelButtonColor: '#aaa',
                    cancelButtonText: 'cancelar',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
            //if user clicks on delete
                    if (result.value) {

                        @this.call('eliminarItem',itemId)

                    }
                });
            });
        })
</script>

@endpush
