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
                            <th>Dolencia</th>
                            <th>Descripción Profesional</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan=3><button class="btn btn-outline-primary" wire:click="agregarItem">Agregar</button></td>
                        <td>
                            <textarea class="form-control" placeholder="Agregar dolencia" rows="1" wire:model.defer="dolenciaAgregar"></textarea>
                            @error('dolenciaAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <textarea class="form-control" placeholder="Agregar descripción profesional" rows="1" wire:model.defer="descripAgregar"></textarea>
                            @error('descripAgregar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    @foreach($dolencias as $index => $dolencia)
                        <tr>
                            <td class="ps-2 p-0">
                                <button class="btn btn-ghost-light btn-icon p-0" wire:click="$emit('triggerDelete',{{ $dolencia->iddolencia }})">
                                    <img src="{{ asset('svg/delete.svg') }}" alt="delete">
                                </button>
                            </td>
                            <td class="pe-2 p-0">
                                <button class="btn btn-ghost-light btn-icon p-0"  wire:click="guardarItem({{$index}})">
                                    <img src="{{ asset('svg/save.svg') }}" alt="save">
                                </button>
                            </td>
                            <td>{{ $dolencia->iddolencia }}</td>
                            <td><textarea class="form-control" rows="1" wire:model.defer="dolencias.{{ $index }}.dolencia"></textarea></td>
                            <td><textarea class="form-control" rows="1" wire:model.defer="dolencias.{{ $index }}.decrip_profesional"></textarea></td>
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
                    text: 'Se eliminará la Dolencia',
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
