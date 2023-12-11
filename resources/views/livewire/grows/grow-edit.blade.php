<div>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/edit-grow.css') }}">
    <div class="card mb-3">
        <div class="card-footer text-end">
            <div class="col">
                <button class="btn btn-link float-start" onclick="window.history.back();">Volver</button>
            </div>
            <div class="col">
                <button wire:click="update" class="btn btn-primary float-sm-end ms-2 mt-1">Guardar</button>
            </div>
            @if($growId)
            <button class="btn btn-danger float-sm-end ms-4 mt-1" wire:click="$emit('triggerDeleteGrow')">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="4" y1="7" x2="20" y2="7"></line>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg>Eliminar</button>
            @if($celular)
            <a class="btn btn-lime float-sm-end ms-1 mt-1" href="https://wa.me/{{ $celular }}" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                    <path
                        d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1">
                    </path>
                </svg>Whatsapp
            </a>
            @endif

            @endif

        </div>
        <div class="card-body border-bottom pt-3 pb-4" >
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-check form-switch ms-2 mt-4">
                        <input class="form-check-input" type="checkbox" wire:model.defer="activo" checked>
                        <span class="form-check-label">Activo</span>
                    </label>
                </div>
                <div class="col-lg-6">
                    <div class="col-sm-8"><label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" wire:model.defer="nombre">
                        @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="col-sm-6"><label class="form-label">CBU</label>
                        <input type="text" class="form-control" wire:model.defer="cbu">
                        @error('cbu')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-sm-8"><label class="form-label">Alias</label>
                        <input type="text" class="form-control" wire:model.defer="alias">
                        @error('alias')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="col-sm-8">
                        <label class="form-label">Titular</label>
                        <input type="text" class="form-control" wire:model.defer="titular">
                        @error('cbu')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-sm-6">
                        <label class="form-label">Mail</label>
                        <input type="text" class="form-control" wire:model.defer="mail">
                        @error('mail')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="col-sm-4">
                        <label class="form-label">Celular</label>
                        <input type="text" class="form-control" wire:model.defer="celular">
                        @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

            </div>

        <!--
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="col-sm-4">
                        <label class="form-label">url</label>
                        <input type="text" class="form-control" wire:model.defer="url">
                        @error('celular')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        -->

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body border-bottom pt-3 pb-4">
            <div class="edit-grow-row">

                <div class="edit-grow-col">
                    <div class="edit-grow-element">
                        <label class="form-label">Código de Descuento</label>
                        <input type="text" class="form-control" wire:model.defer="cod_desc">
                        @error('cod_desc')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="edit-grow-element">
                        <label class="form-label">Link de rastreo</label>
                        <div style="display:flex;flex-direction:row;">
                            <input value={{$linkDeRastreo}} class="form-control" type="text" onlyread>
                            <button id="copiarBoton" onClick='copiarAlPortapapeles("{{$linkDeRastreo}}")' class='btn btn-primary' style="margin-left:10px;max-height:50px">Copiar</button>
                        </div>
                    </div>

                    <div class="edit-grow-element">
                        <img id="qrImagen" style='margin:15px;width:150px;border-radius:10px' src="{{$qrImage}}" alt="Imagen Generada" id="imagenGenerada">
                        <button class='btn btn-primary center' onclick="copiarQR()" style="padding-right: 4px">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="14" r="2" />
                                <polyline points="14 4 14 8 8 8 8 4" />
                            </svg>
                        </button>
                    </div>


                    <div class="edit-grow-element">
                        <label class="form-label">Porcentaje de descuento {{'(%)'}}</label>
                        <input  class="form-control" type="number" wire:model.defer='descuento'>
                    </div>

                    <div class="edit-grow-element">
                        <label class="form-label">Fecha de Ingreso</label>
                        <input class="form-control" type="date" wire:model.defer="fe_ingreso" >
                        @error('fe_ingreso')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                   </div>

                    <div class="edit-grow-col">

                    <div class="edit-grow-element">
                        <label class="form-label">Provincia *</label>
                        <select class="form-select" wire:model.defer="idprovincia">
                            <option value="">Seleccione Provincia</option>
                            @foreach($provincias as $pcia)
                            <option value="{{ $pcia->Id }}">{{ $pcia->Provincia }}</option>
                            @endforeach
                        </select>
                        @error('idprovincia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="edit-grow-element">
                        <label class="form-label">Localidad</label>
                        <input type="text" class="form-control" wire:model.defer="localidad" >
                        @error('localidad')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="edit-grow-element">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" wire:model.defer="direccion">
                        @error('direccion')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                   <div class="edit-grow-element">
                        <label class="form-label">Cod. Postal</label>
                        <input type="text" class="form-control" wire:model.defer="cp">
                        @error('cp')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>


                    <div class="edit-grow-element">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="example-textarea-input" rows="3"
                            wire:model.defer="observ"></textarea>
                        @error('observ')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body border-bottom pt-3 pb-4">
            <div class="row mb-3">
                <div class="col-md-6 mt-3">
                    <div class="col-md-10">
                        <label class="form-label">Imagen 1</label>
                        <input type="file" wire:model="imagen1" />
                    </div>
                    @if($imagen1_path)
                    <img class="mt-2" src="{{asset('img/uploads/' . $imagen1_path)}}" width="250" /><br />
                    <button class="btn btn-ghost-danger mt-3" id="edit-copiar" wire:click="eliminarImagen1">Eliminar Foto</button>
                    @endif
                </div>
                <div class="col-md-6 mt-3">
                    <div class="col-md-10">
                        <label class="form-label">Imagen 2</label>
                        <input type="file" wire:model="imagen2" />
                    </div>
                    @if($imagen2_path)
                    <img class="mt-2" src="{{asset('img/uploads/' . $imagen2_path)}}" width="250" /><br />
                    <button class="btn btn-ghost-danger mt-3" wire:click="eliminarImagen2">Eliminar Foto</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
          @this.on('triggerDeleteGrow', () => {
              Swal.fire({
                  title: 'Está Seguro?',
                  text: 'Se eliminará el Grow',
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

      function copiarAlPortapapeles(texto) {
        navigator.clipboard.writeText(texto)
            .then(() => {
                // Copiado exitoso
                var boton = document.getElementById("copiarBoton");
                boton.style.backgroundColor = "#58D035";
                boton.innerHTML = "Copiado!";
                setTimeout(function() {
                    boton.style.backgroundColor = "";
                    boton.innerHTML = "Copiar";
                }, 3000); // Volver a la configuración original después de 2 segundos
            })
            .catch((error) => {
                // Manejar errores, por ejemplo, si no se permite el acceso al portapapeles
                console.error('Error al copiar al portapapeles: ', error);
            });
    }

    function copiarQR() {
        var imagen = document.getElementById('qrImagen');
        var canvas = document.createElement('canvas');
        var contexto = canvas.getContext('2d');

        canvas.width = 300;
        canvas.height = 300;
        contexto.drawImage(imagen, 0, 0);

        canvas.toBlob(function(blob) {
            var item = new ClipboardItem({ 'image/png': blob });
            navigator.clipboard.write([item]);

        }, 'image/png');

        Livewire.emit('imagenCopiada');
    }

    document.addEventListener('DOMContentLoaded', function() {
            // Obtener referencias a las imágenes
            var imagenFondo = document.getElementById('imagenFondo');
            var imagenQR = document.getElementById('imagenQR');

            // Crear una imagen resultante al superponer el código QR en la imagen de fondo
            var imagenResultante = combinarImagenes(imagenFondo, imagenQR);

            // Obtener referencia al botón de descarga
            var botonDescargar = document.getElementById('descargarBoton');

            // Agregar un evento de clic al botón de descarga
            botonDescargar.addEventListener('click', function() {
                // Crear un enlace temporal y hacer clic en él para iniciar la descarga
                var enlaceTemporal = document.createElement('a');
                enlaceTemporal.href = imagenResultante.src;
                enlaceTemporal.download = 'imagen_resultante.png';
                enlaceTemporal.click();
            });
        });

        // Función para combinar dos imágenes
        function combinarImagenes(imagenFondo, imagenQR) {
            // Crear un lienzo (canvas)
            var lienzo = document.createElement('canvas');
            var contexto = lienzo.getContext('2d');

            // Establecer las dimensiones del lienzo igual al tamaño de la imagen de fondo
            lienzo.width = imagenFondo.width;
            lienzo.height = imagenFondo.height;

            // Dibujar la imagen de fondo en el lienzo
            contexto.drawImage(imagenFondo, 0, 0);

            // Dibujar la imagen del código QR en el lienzo
            contexto.drawImage(imagenQR, 50, 50, 200, 200); // Ajustar según sea necesario

            // Crear una nueva imagen resultante
            var imagenResultante = new Image();
            imagenResultante.src = lienzo.toDataURL('image/png');

            return imagenResultante;
        }

</script>


@endpush
