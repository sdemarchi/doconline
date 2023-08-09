<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            @if( session()->has('error'))
                <div class="alert alert-danger m-4">
                    {!! session('error') !!}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th width="30"></th>
                            <th width="30"></th>
                            <th width="50">N°</th>
                            <th>Modo Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan=3><button class="btn btn-outline-primary" wire:click="agregarItem">Agregar</button></td>
                        <td>
                            <textarea class="form-control" placeholder="Agregar Modo de Contacto" rows="1" wire:model.defer="contactoAgregar"></textarea>
                            @error('contactoAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    @foreach($contactos as $index => $contacto)
                        <tr>
                            <td class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon" wire:click="$emit('triggerDelete',{{ $contacto->idcontacto }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </td>
                            <td class="pe-2 p-0">
                                <button class="btn btn-ghost-light btn-icon"  wire:click="guardarItem({{$index}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" />
                                    </svg>
                                </button>
                            </td>
                            <td>{{ $contacto->idcontacto }}</td>
                            <td><textarea class="form-control" rows="1" wire:model.defer="contactos.{{ $index }}.modo_contacto"></textarea></td>
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
                    text: 'Se eliminará el Modo de Contacto',
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