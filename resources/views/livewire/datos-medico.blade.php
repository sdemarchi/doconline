
        
           
<div class="card">
  <div class="card-footer text-end">
      <div class="d-flex">
        <button wire:click="update" class="btn btn-primary ms-auto">Guardar</button>
      </div>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Apellido y Nombre</label>
            <div class="col">
              <input type="text" class="form-control" wire:model.defer="datos.apeynom">
              @error('datos.apeynom')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Tipo y N° Documento</label>
            <div class="col-6">
              <input type="text" class="form-control" wire:model.defer="datos.tipo_nro_doc">
              @error('datos.tipo_nro_doc')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Matrícula</label>
            <div class="col-4">
              <input type="text" class="form-control" wire:model.defer="datos.matricula">
              @error('datos.matricula')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Especialidad</label>
            <div class="col-6">
              <input type="text" class="form-control" wire:model.defer="datos.especialidad">
              @error('datos.especialidad')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Domicilio</label>
            <div class="col">
              <input type="text" class="form-control" wire:model.defer="datos.domicilio">
              @error('datos.domicilio')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Teléfono Particular</label>
            <div class="col-4">
              <input type="text" class="form-control" wire:model.defer="datos.tel_part">
              @error('datos.tel_part')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Teléfono Celular</label>
            <div class="col-4">
              <input type="text" class="form-control" wire:model.defer="datos.tel_cel">
              @error('datos.tel_cel')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Email</label>
            <div class="col-6">
              <input type="text" class="form-control" wire:model.defer="datos.email">
              @error('datos.email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Firma</label>
            <div class="col">
              <img src="{{ asset('/img/uploads/' . $datos->firma) }}" height="100"/>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <div class="col-3"></div>
            <div class="col">
              <input type="file" wire:model="firma">
              <div wire:loading wire:target="firma">Subiendo Archivo...</div>
              @error('firma')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <label class="form-label col-3 col-form-label">Sello</label>
            <div class="col">
              <img src="{{ asset('/img/uploads/' . $datos->sello) }}" height="100"/>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-lg-10">
          <div class="form-group row">
            <div class="col-3"></div>
            <div class="col">
              <input type="file" wire:model="sello">
              <div wire:loading wire:target="sello">Subiendo Archivo...</div>
              @error('sello')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    
  
  