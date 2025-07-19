<div class="card">
    <div class="card-footer text-end">
      <div class="row">
        <div class="col-sm-1">
          <button class="btn btn-link float-start" onclick="window.history.back();">Volver</button>
        </div>
        <div class="col-sm-11">
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
      <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#acc-pacientes">
        <div class="accordion-body pt-0">
          <div class="row">
            
            <div class="row">
              <div class="col-md-6 mt-4">
                <label class="form-label">Apellido y Nombre *</label>
                <input type="text" class="form-control" wire:model.defer="nom_ape" disabled>
              </div>
              <div class="col-md-4 mt-4">
                <label class="form-label">DNI *</label>
                <input type="text" class="form-control" wire:model.defer="dni" disabled>
              </div>
             
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
          $("#aclaracion").jSignature({syncFormat: 'PNG', height:200})
          $("#firma").jSignature("importData","<?php echo $firma ?>");
          $("#aclaracion").jSignature("importData","<?php echo $aclaracion ?>");
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
  </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      @this.on('guardar', ()  => {
        @this.call('update');
        
      });
    });
    </script>
 
  
  
  @endpush