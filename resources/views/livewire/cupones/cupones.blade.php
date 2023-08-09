<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th width="30"></th>
                            <th width="50">Id</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th width="150">Descuento</th>
                            <th width="100">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan=2><button class="btn btn-outline-primary" wire:click="agregarCupon">Agregar</button></td>
                        <td>
                            <input type="text" class="form-control" wire:model.defer="cuponAgregar">
                            @error('cuponAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" wire:model.defer="descripcionAgregar">
                            @error('descripcionAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" wire:model.defer="descuentoAgregar">
                            @error('descuentoAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    @foreach($cupones as $cupon)
                        <tr>
                            <td class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerDelete',{{ $cupon->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </td>
                            
                            <td>{{ $cupon->id }}</td>
                            <td>{{ $cupon->codigo }}</td>
                            <td>{{ $cupon->descripcion }}</td>
                            <td class="text-end">{{ number_format($cupon->descuento, 2, ',', '.') }}</td>
                            <td>
                                @if($cupon->activo)
                                  <span class="btn badge bg-success me-1" wire:click="switch({{ $cupon->id }},0)"></span>Activo
                                @else
                                  <span class="btn badge bg-danger me-1" wire:click="switch({{ $cupon->id }},1)"></span>Inactivo
                                @endif
                            </td>
                        </tr>
                    @endforeach
                        
                    </tbody>
                    
                </table>
                {{ $cupones->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', id => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se eliminará el Cupón',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#ec536c',
                    cancelButtonColor: '#aaa',
                    cancelButtonText: 'cancelar',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
            //if user clicks on delete
                    if (result.value) {
                
                        @this.call('eliminar',id)
                
                    }
                });
            });
        })
</script>
    
@endpush