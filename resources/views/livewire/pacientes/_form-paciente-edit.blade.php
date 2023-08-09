<div class="card">
  <div class="card-footer text-end">
    <div class="row">
      <div class="col-sm-1">
        <button class="btn btn-link float-start" onclick="window.history.back();">Volver</button>
      </div>
      <div class="col-sm-11">
        <button class="btn btn-primary float-sm-end ms-4 mt-2" wire:click="$emit('guardar')">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
            <circle cx="12" cy="14" r="2"></circle>
            <polyline points="14 4 14 8 8 8 8 4"></polyline>
          </svg>
          Guardar</button>
        <button class="btn btn-danger float-sm-end ms-4 mt-2" wire:click="$emit('triggerDeletePaciente')">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="4" y1="7" x2="20" y2="7"></line>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
          </svg>Eliminar</button>
        <a class="btn btn-lime float-sm-end ms-1 mt-2" href="https://wa.me/{{ $celular }}" target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
            <path
              d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1">
            </path>
          </svg>Whatsapp
        </a>
        @if($pacienteId)
        <a class="btn btn-secondary float-sm-end ms-1 mt-2" href="{{ route('paciente.pronto-despacho',$pacienteId) }}"
          target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
          </svg>
          Pronto Despacho</a>
        <a class="btn btn-secondary float-sm-end ms-1 mt-2" href="{{ route('paciente.consentimiento',$pacienteId) }}"
          target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
          </svg>
          Consentimiento</a>
        <a class="btn btn-secondary float-sm-end ms-1 mt-2" href="{{ route('paciente.declaracion',$pacienteId) }}"
          target="_blank">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
          </svg>
          Decl. Jurada</a>

        @endif
      </div>

    </div>
  </div>
  <div class="card-body">
    <div class="accordion" id="acc-pacientes">
      <div class="accordion-item theme-dark">
        <h2 class="accordion-header" id="heading-1">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1"
            aria-expanded="true">
            Datos Personales
          </button>
        </h2>
        <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#acc-pacientes">
          <div class="accordion-body pt-0">
            <div class="row">
              <div class="row">
                <div class="col-md-2 mt-4">
                  @if($pacienteId)
                    <label class="form-label">N°</label>
                    <input type="text" class="form-control" wire:model.defer="pacienteId" disabled>
                  @endif
                </div>
                <div class="col-md-2 mt-5">
                  <label class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" wire:model.defer="pagado" checked>
                    <span class="form-check-label">Pagado</span>
                  </label>
                  <label class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" wire:model.defer="pagado2023" checked>
                    <span class="form-check-label">Pagado2023</span>
                  </label>
                </div>
                <div class="col-md-2 mt-4">
                  <label class="form-label">Estado</label>
                  <select class="form-select" wire:model.defer="estado">
                    <option value=""></option>
                    <option value="P">Por Realizar</option>
                    <option value="H">Hecho</option>
                    <option value="3">Hecho 2023</option>
                    <option value="E">Espera</option>
                    <option value="2">En espera 2</option>
                    <option value="A">Aprobado</option>
                    <option value="R">Rechazado</option>
                    <option value="N">No Responde</option>
                  </select>
                  @error('estado')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2 mt-4">
                  <label class="form-label">Fecha de Carga</label>
                  <input class="form-control" type="date" wire:model.defer="fe_carga" style="width:150px">
                  @error('fe_carga')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mt-4">
                  <label class="form-label">Correo Electrónico *</label>
                  <input type="text" class="form-control" wire:model.defer="email">
                  @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-3 mt-4">
                  <label class="form-label">Apellido y Nombre *</label>
                  <input type="text" class="form-control" wire:model.defer="nom_ape">
                  @error('nom_ape')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2 mt-4">
                  <label class="form-label">DNI *</label>
                  <input type="text" class="form-control" wire:model.defer="dni">
                  @error('dni')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mt-4">
                  <label class="form-label">Código de vinculación del Reprocann</label>
                  <input type="text" class="form-control" wire:model.defer="cod_vincu">
                  @error('cod_vinco')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mt-4">
                  <label class="form-label">Instagram</label>
                  <input type="text" class="form-control" wire:model.defer="instagram">
                  @error('instagram')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-2 mt-4">
                  <label class="form-label">Fecha de Nac. *</label>
                  <input class="form-control" type="date" wire:model.defer="fe_nacim" style="width:150px">
                  @error('fe_nacim')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-1 mt-4">
                  <label class="form-label">Edad *</label>
                  <input type="text" class="form-control" wire:model.defer="edad">
                  @error('edad')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mt-4">
                  <label class="form-label">Celular *</label>
                  <input type="text" class="form-control" wire:model.defer="celular">
                  @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mt-4">
                  <label class="form-label">Ocupación o Trabajo *</label>
                  <input type="text" class="form-control" wire:model.defer="ocupacion">
                  @error('ocupacion')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2 mt-4">
                  <label class="form-label">Obra Social *</label>
                  <input type="text" class="form-control" wire:model.defer="osocial">
                  @error('osocial')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <button class="btn btn-primary mt-2" wire:click="actualizarFechaEdad()">
                    Actualiz. Fecha de carga y Edad</button>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-3 mt-4">
                  <label class="form-label">Domicilio *</label>
                  <input type="text" class="form-control" wire:model.defer="domicilio">
                  @error('domicilio')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mt-4">
                  <label class="form-label">Provincia *</label>
                  <select class="form-select" wire:model.defer="idprovincia">
                    <option value="">Seleccione Provincia</option>
                    @foreach($provincias as $pcia)
                    <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                    @endforeach
                  </select>
                  @error('idprovincia')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mt-4">
                  <label class="form-label">Localidad *</label>
                  <input type="text" class="form-control" wire:model.defer="localidad">
                  @error('localidad')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3 mt-4">
                  <label class="form-label">Código Postal *</label>
                  <input type="text" class="form-control" wire:model.defer="cp">
                  @error('cp')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              
              <div class="row">
                <div class="col mt-4">
                  <label class="form-label">Comentarios sobre su estado de salud que quiera comentar o aclarar</label>
                  <input type="text" class="form-control" wire:model.defer="comentario">
                  @error('comentario')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Marque si tiene</label>
                  @foreach($dolencias as $dol)
                  <label class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" @if(in_array($dol->iddolencia,$dolores)) checked
                    @endif wire:click="switchDolencia({{$dol->iddolencia}},'{{$dol->dolencia}}')">
                    <span class="form-check-label">{{ $dol->dolencia }}</span>
                  </label>
                  @endforeach
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Foto de la FIRMA y ACLARACION</label>
                  <input type="file" class="form-control" wire:model="foto_firma" />
                </div>
                @if($foto_firma_img)
                <img src="{{asset('img/uploads/' . $foto_firma_img)}}" width="250" /><br />
                <button class="btn btn-ghost-danger mt-3" wire:click="eliminarFotoFirma">Eliminar Foto</button>
                @endif
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Firma *</label>
                  <div id="firma"></div>
                  <button class="btn btn-primary ms-auto" wire:click="$emit('limpiarFirma')">Limpiar</button>
                  <button class="btn btn-success btn-icon" wire:click="$emit('guardarFirma')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                      <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                      <path d="M14 4l0 4l-6 0l0 -4"></path>
                   </svg>
                  </button>
                  
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Aclaración *</label>
                  <div id="aclaracion"></div>
                  <button class="btn btn-primary ms-auto" wire:click="$emit('limpiarAclaracion')">Limpiar</button>
                  <button class="btn btn-success btn-icon" wire:click="$emit('guardarAclaracion')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                      <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                      <path d="M14 4l0 4l-6 0l0 -4"></path>
                   </svg>
                  </button>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Tiene Arritmias en actividad? *</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="arritmia" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="arritmia" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Tiene antecedentes de algún padecimiento en salud mental? ¿Se encuentra
                    actualmente en tratamiento? *</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="salud_mental" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="salud_mental" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">En caso de Si, especificar *</label>
                  <textarea class="form-control" name="example-textarea-input" rows="3"
                    wire:model.defer="salud_ment_esp"></textarea>
                  @error('salud_ment_esp')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">
                    ¿Tiene alergia a algún componente de la planta? *</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="alergia" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="alergia" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Esta embarazada o realizando lactancia? *</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="embarazada" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="embarazada" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Maneja maquinarias de alta precisión? *</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="maneja_maq" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="maneja_maq" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Comente con sus palabras enfermedad y/o dolencias que padece que justifiquen
                    el uso de cannabis medicinal *</label>
                  <textarea class="form-control" name="example-textarea-input" rows="6"
                    placeholder="dolor, hernias, etc" wire:model.defer="patologia"></textarea>
                  @error('patologia')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Cómo nos contactó? *</label>
                  @foreach($modos_contacto as $mod)
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="idcontacto"
                      value="{{$mod->idcontacto}}" wire:click="refresh()">
                    <span class="form-check-label">{{ $mod->modo_contacto }}</span>
                  </label>
                  @endforeach
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-lg-6 col-md-8">
                  <label class="form-label">Contacto Otro</label>
                  <input type="text" class="form-control" wire:model.defer="contacto_otro">
                  @error('contacto_otro')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Otra persona cultivará para el paciente?</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="es_menor" value="1"
                      wire:click="refresh()">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model.defer="es_menor" value="0"
                      wire:click="refresh()">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      @if($es_menor)
      <div class="accordion-item theme-dark">
        <h2 class="accordion-header" id="heading-2">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2"
            aria-expanded="false">
            Datos del Padre / Madre / Tutor o Encargado
          </button>
        </h2>
        <div id="collapse-2" class="accordion-collapse collapse show" data-bs-parent="#acc-datos-tutor">
          <div class="accordion-body pt-0">
            <div class="row">

              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Apellido y Nombre *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_apeynom">
                  @error('tut_apeynom')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-6">
                  <label class="form-label">Tipo y N° Documento *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_tipo_nro_doc">
                  @error('tut_tipo_nro_doc')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Fecha Nacimiento *</label>
                  <input class="form-control" type="date" wire:model.defer="tut_fe_nacim" style="width:150px">
                  @error('tut_fe_nacim')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Domicilio</label>
                  <input type="text" class="form-control" wire:model.defer="tut_domicilio">
                  @error('tut_domicilio')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Localidad *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_localidad">
                  @error('tut_localidad')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Provincia *</label>
                  <select class="form-select" wire:model.defer="tut_idprovincia">
                    @foreach($provincias as $pcia)
                    <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-4">
                  <label class="form-label">Código Postal *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_cp">
                  @error('tut_cp')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-8">
                  <label class="form-label">Vínculo con la persona que requiere la inscripción *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_vinculo">
                  @error('tut_vinculo')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-4">
                  <label class="form-label">Teléfono Particular</label>
                  <input type="text" class="form-control" wire:model.defer="tut_tel_part">
                  @error('tut_tel_part')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-4">
                  <label class="form-label">Teléfono Celular *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_tel_cel">
                  @error('tut_tel_cel')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-6">
                  <label class="form-label">Correo Electrónico *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_mail">
                  @error('tut_mail')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-6">
                  <label class="form-label">Obra Social *</label>
                  <input type="text" class="form-control" wire:model.defer="tut_osocial">
                  @error('tut_osocial')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-8">
                  <label class="form-label">¿Registro de Familiares?</label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="tut_reg_fam" value="1">
                    <span class="form-check-label">Sí</span>
                  </label>
                  <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="tut_reg_fam" value="0">
                    <span class="form-check-label">No</span>
                  </label>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      @endif
      @if($pacienteId)
      <div class="accordion-item theme-dark">
        <h2 class="accordion-header" id="heading-3">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3"
            aria-expanded="false">
            Patologías
          </button>
        </h2>
        <div id="collapse-3" class="accordion-collapse collapse show" data-bs-parent="#acc-patologias">
          <div class="accordion-body pt-0">
            <div class="table-responsive">
              <table class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Patología</th>
                    <th>Año Aparición</th>
                    <th>¿Qué medicación toma para esto?</th>
                    <th>Vinculado trabajo</th>
                    <th>¿Del 1 al 10 cuánto le duele?</th>
                    <th>Partes del cuerpo donde le duele</th>
                    <th>¿Atenúa Dolor?</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><button class="btn btn-outline-primary" wire:click="agregarPatologia()">Agregar</button></td>
                    <td>
                      <select class="form-select" wire:model.defer="patologiaAgregar">
                        <option value=""></option>
                        @foreach($dolencias as $dol)
                        <option value="{{ $dol->iddolencia }}">{{ $dol->dolencia }}</option>
                        @endforeach
                      </select>
                      @error('patologiaAgregar')<div class="text-danger">{{ $message }}</div>@enderror
                    </td>
                  </tr>
                  @foreach($patologias as $index => $item)
                  <tr>
                    <td>
                      <button class="btn btn-ghost-light btn-icon"
                        wire:click="$emit('triggerDelete',{{ $item->idpato }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                          stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                          stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <line x1="4" y1="7" x2="20" y2="7" />
                          <line x1="10" y1="11" x2="10" y2="17" />
                          <line x1="14" y1="11" x2="14" y2="17" />
                          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                      </button>
                      <button class="btn btn-ghost-light btn-icon" wire:click="guardarPatologia({{$index}})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                          stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                          stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                          <circle cx="12" cy="14" r="2" />
                          <polyline points="14 4 14 8 8 8 8 4" />
                        </svg>
                      </button>
                    </td>
                    <td>@if($item->patologia){{ $item->patologia->dolencia }}@else ???? @endif</td>
                    <td><input type="text" class="form-control" wire:model.defer="patologias.{{ $index }}.anio_aprox" />
                    </td>
                    <td><textarea class="form-control" wire:model.defer="patologias.{{ $index }}.medicacion"></textarea>
                    </td>
                    <td>
                      <select class="form-select" wire:model.defer="patologias.{{ $index }}.prob_trabajo">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                      </select>
                    </td>
                    <td><input type="text" class="form-control"
                        wire:model.defer="patologias.{{ $index }}.dolor_intensidad" /></td>
                    <td><textarea class="form-control"
                        wire:model.defer="patologias.{{ $index }}.partes_cuerpo"></textarea></td>
                    <td>
                      <select class="form-select" wire:model.defer="patologias.{{ $index }}.atenua_dolor">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                      </select>
                    </td>
                  </tr>
                  @endforeach

                </tbody>

              </table>
              @error('patologias.*.anio_aprox')<div class="text-danger">{{ $message }}</div>@enderror
              @error('patologias.*.medicacion')<div class="text-danger">{{ $message }}</div>@enderror
              @error('patologias.*.dolor_intensidad')<div class="text-danger">{{ $message }}</div>@enderror
              @error('patologias.*.partes_cuerpo')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="accordion-item theme-dark">
        <h2 class="accordion-header" id="heading-4">
          <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4"
            aria-expanded="false">
            Datos Médicos
          </button>
        </h2>
        <div id="collapse-4" class="accordion-collapse collapse show" data-bs-parent="#acc-datos-medicos">
          <div class="accordion-body pt-0">
            <div class="row">
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Resumen Historia Clínica</label>
                  <textarea class="form-control" name="example-textarea-input" rows="6"
                    wire:model.defer="res_historia"></textarea>
                  @error('res_historia')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Whatsapp</label>
                  <a href="https://wa.me/{{ $celular }}" target="_blank">
                    <img src="{{ asset('img/logo-whatsapp.svg.webp')}}" width="50" /></a>
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Beneficios del Tratamiento</label>
                  <textarea class="form-control" name="example-textarea-input" rows="6"
                    wire:model.defer="beneficios"></textarea>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Beneficios Items</label>
                  @foreach($beneficiosList as $benef)
                  <button class="btn btn-secondary btn-sm btn-pill mb-1 py-1 px-3"
                    wire:click="switchBeneficio({{ $benef->idbeneficio }})">{{ $benef->beneficio }}</button>
                  @endforeach
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Justificación</label>
                  <textarea class="form-control" name="example-textarea-input" rows="6"
                    wire:model.defer="justificacion"></textarea>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Justificación Items</label>
                  @foreach($justificaciones as $justif)
                  <button class="btn btn-secondary btn-sm btn-pill mb-1 py-1 px-3"
                    wire:click="switchJustificacion({{ $justif->idjustifica }})">{{ $justif->justificacion }}</button>
                  @endforeach
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Diagnóstico</label>
                  <textarea class="form-control" name="example-textarea-input" rows="6"
                    wire:model.defer="diagnostico"></textarea>
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Diagnóstico Items</label>
                  @foreach($diagnosticos as $diag)
                  <button class="btn btn-secondary btn-sm btn-pill mb-1 py-1 px-3"
                    wire:click="switchDiagnostico({{ $diag->iddiagnostico }})">{{ $diag->diagnostico }}</button>
                  @endforeach
                </div>
              </div>

              <!--<div class="col-md-6 mt-3">
                  <div class="col-md-10">
                    <label class="form-label">Tratamiento</label>
                    <textarea class="form-control" name="example-textarea-input" rows="6" wire:model.defer="tratamiento"></textarea>
                  </div>
                </div>  
                <div class="col-md-6 mt-3">
                  <div class="col-md-10">
                    <label class="form-label">Tratamiento Items</label>
                    @foreach($tratamientos as $trat)
                      <button class="btn btn-secondary btn-sm btn-pill mb-1 py-1 px-3" wire:click="switchTratamiento({{ $trat->idtrata }})">{{ $trat->tratamiento }}</button>
                    @endforeach
                  </div>
                </div> -->

              <div class="col-md-6 mt-3">
                <div class="col-lg-3 col-md-4">
                  <label class="form-label">Cantidad Plantas</label>
                  <input type="text" class="form-control" wire:model.defer="cant_plantas">
                  @error('cant_plantas')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-3 col-md-4">
                  <label class="form-label">Frecuencia de Analítica</label>
                  <input type="text" class="form-control" wire:model.defer="frecuencia">
                  @error('frecuencia')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Dosis</label>
                  <input type="text" class="form-control" wire:model.defer="dosis">
                  @error('dosis')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-4 col-md-6">
                  <label class="form-label">Concentración THC %</label>
                  <input type="text" class="form-control" wire:model.defer="conc_thc">
                  @error('conc_thc')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-lg-4 col-md-6">
                  <label class="form-label">Concentración CBD %</label>
                  <input type="text" class="form-control" wire:model.defer="conc_cbd">
                  @error('conc_cbd')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-lg-10 col-md-10">
                  <label class="form-label">Producto</label>
                  @foreach($productos as $prod)
                  <label class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" @if(in_array($prod->idproducto,$producto)) checked
                    @endif wire:click="switchProducto({{$prod->idproducto}})">
                    <span class="form-check-label">{{ $prod->producto }}</span>
                  </label>
                  @endforeach
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Tratam. Previo</label>
                  <input type="text" class="form-control" wire:model.defer="tratam_previo">
                  @error('tratam_previo')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Producto Indicado</label>
                  <textarea class="form-control" name="example-textarea-input" rows="3"
                    wire:model.defer="producto_indicado"></textarea>
                  @error('producto_indicado')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

              <div class="col-md-6 mt-3">
                <div class="col-md-10">
                  <label class="form-label">Síntomas</label>
                  <textarea class="form-control" name="example-textarea-input" rows="2"
                    wire:model.defer="sintomas"></textarea>
                  @error('sintomas')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
          $("#firma").jSignature({syncFormat: 'PNG', height:200})
          $("#aclaracion").jSignature({syncFormat: 'PNG', height:200})
          $("#firma").jSignature("importData","<?php echo $firma ?>");
          $("#aclaracion").jSignature("importData","<?php echo $aclaracion ?>");    

      });
      document.addEventListener('refresh', function () {
        $("#firma").jSignature({syncFormat: 'PNG', height:200})
        $("#firma").jSignature("importData","<?php echo $firma ?>");
      });
        
      document.addEventListener('DOMContentLoaded', function () {
        @this.on('guardar', ()  => {
          //e.preventDefault();
          let firmaData =  $('#firma').jSignature('getData', 'default');
          let aclaracData =  $('#aclaracion').jSignature('getData', 'default');
          @this.call('setFirma',firmaData);
          @this.call('setAclaracion',aclaracData);
          @this.call('update');
          
        });
      });
      document.addEventListener('DOMContentLoaded', function () {
        @this.on('guardarFirma', ()  => {
          //e.preventDefault();
          let firmaData =  $('#firma').jSignature('getData', 'default');
          @this.call('guardarFirma',firmaData);
          
        });
      });
      document.addEventListener('DOMContentLoaded', function () {
        @this.on('guardarAclaracion', ()  => {
          //e.preventDefault();
          let aclaracData =  $('#aclaracion').jSignature('getData', 'default');
          @this.call('guardarAclaracion',aclaracData);
        });
      });
      document.addEventListener('DOMContentLoaded', function () {
          @this.on('limpiarFirma', ()  => {
            //e.preventDefault();
            $("#firma").jSignature("reset");
          });
      });
      document.addEventListener('DOMContentLoaded', function () {
          @this.on('limpiarAclaracion', ()  => {
            //e.preventDefault();
            $("#aclaracion").jSignature("reset");
          });
      });
</script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerDelete', itemId => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se quitará la Patología',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'cancelar',
                  confirmButtonText: 'Quitar!'
              }).then((result) => {
          //if user clicks on delete
                  if (result.value) {
              
                      @this.call('quitarPatologia',itemId)
              
                  }
              });
          });
      })
</script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerDeletePaciente', () => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se eliminará el Registro del Paciente',
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: '#ec536c',
                  cancelButtonColor: '#aaa',
                  cancelButtonText: 'cancelar',
                  confirmButtonText: 'Eliminar!'
              }).then((result) => {
                  if (result.value) {
              
                      @this.call('eliminar')
              
                  }
              });
          });
      })
      
</script>


@endpush