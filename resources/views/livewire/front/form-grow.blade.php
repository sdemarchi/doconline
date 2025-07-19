<div class="page pt-5">
    <div class="container">
        <div class="text-center mb-4">
            <a href="#"><img src="{{asset('img/logo-doconline-b-500.png')}}" width="300" /></a>
        </div>
        <div class="text-center mb-4">
            <h1>Registre su Grow completando el siguiente formulario</h1>
        </div>

        <div class="card mb-3">
            <div class="card-footer text-center">
                <div class="col mx-auto">
                    <button wire:click="update" class="btn btn-primary ms-2 mt-1">Enviar</button>
                </div>
            </div>
            <div class="card-body border-bottom pt-3 pb-4">
                <div class="row mb-3">

                    <div class="col-lg-6">
                        <div class="col-sm-8"><label class="form-label">Nombre *</label>
                            <input type="text" class="form-control" wire:model.defer="nombre">
                            @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-6"><label class="form-label">CBU</label>
                            <input type="text" class="form-control" wire:model.defer="cbu">
                            @error('cbu')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="col-sm-8"><label class="form-label">Alias</label>
                            <input type="text" class="form-control" wire:model.defer="alias">
                            @error('alias')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-8">
                            <label class="form-label">Titular de la Cuenta</label>
                            <input type="text" class="form-control" wire:model.defer="titular">
                            @error('cbu')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="col-sm-6">
                            <label class="form-label">E-Mail</label>
                            <input type="text" class="form-control" wire:model.defer="mail">
                            @error('mail')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-6">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" wire:model.defer="instagram">
                            @error('mail')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="col-sm-4">
                            <label class="form-label">Celular *</label>
                            <input type="text" class="form-control" wire:model.defer="celular">
                            @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-4">
                            <label class="form-label">Confirme Celular *</label>
                            <input type="text" class="form-control" wire:model.defer="celularConf">
                            @error('celularConf')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="col-sm-8">
                            <label class="form-label">Provincia *</label>
                            <select class="form-select" wire:model.defer="idprovincia">
                                <option value="">Seleccione Provincia</option>
                                @foreach($provincias as $pcia)
                                <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                                @endforeach
                            </select>
                            @error('idprovincia')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-8">
                            <label class="form-label">Localidad</label>
                            <input type="text" class="form-control" wire:model.defer="localidad">
                            @error('localidad')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="col-sm-6">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" wire:model.defer="direccion">
                            @error('direccion')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-sm-4">
                            <label class="form-label">Cod. Postal</label>
                            <input type="text" class="form-control" wire:model.defer="cp">
                            @error('cp')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="col-sm-4">
                                <label class="form-label">Código de Descuento</label>
                                <input type="text" class="form-control" wire:model.defer="cod_desc">
                                @error('cod_desc')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <div class="col mx-auto">
                    <button wire:click="update" class="btn btn-primary ms-2 mt-1">Enviar</button>
                </div>
            </div>

        </div>

    </div>
</div>