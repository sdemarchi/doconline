<div class="card">
    <div class="card-footer text-end">
        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-link float-start" onclick="window.history.back();">Volver</button>
            </div>
            <div class="col-sm-10">
                <button class="btn btn-primary float-sm-end ms-4 mt-2" wire:click="update()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    Guardar</button>

            </div>

        </div>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-6">
                    <label class="form-label">Fecha *</label>
                    <input type="date" class="form-control" wire:model.defer="fecha">
                    @error('fecha')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-8">
                    <label class="form-label">Buscar Paciente</label>
                    <div>
                        <select class="form-control select-paciente" id="select-paciente">
                            <option value="{{ $pacienteId }}" selected="selected">{{ $pacienteNombre }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-8">
                    <label class="form-label">Nombre y Apellido</label>
                    <input type="text" class="form-control" wire:model.defer="nombre">
                    @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-4">
                    <label class="form-label">DNI</label>
                    <input type="text" class="form-control" wire:model.defer="dni">
                    @error('dni')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col-md-8">
                    <label class="form-label">Obra Social</label>
                    <input type="text" class="form-control" wire:model.defer="obraSocial">
                    @error('obraSocial')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col">
                    <label class="form-label">Detalle de la Receta</label>
                    <textarea class="form-control" wire:model.defer="detalle" rows="6"></textarea>
                    @error('detalle')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-3">
                <div class="col">
                    <label class="form-label">Diagnóstico</label>
                    <textarea class="form-control" wire:model.defer="diagnostico" rows="4"></textarea>
                    @error('diagnostico')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('scripts')
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-paciente').select2({
                ajax: {
                    url: '{{ route("api.pacienteSelect")}}',
                    dataType: 'json'
                }
            });
            $('#select-paciente').on('change', function (e) {
                var data = $('#select-paciente').select2("val");
                @this.set('pacienteId', data);
                @this.call('buscarPaciente',data);
            });
        });
        window.initSelect2 = () => {
            $('.select-paciente').select2({
                ajax: {
                    url: '{{ route("api.pacienteSelect")}}',
                    dataType: 'json'
                }
            });
        }
        
    </script>
@endpush