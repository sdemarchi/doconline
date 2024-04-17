<div class="row row-cards">
    <style>
        .doc-button{
            background-color: rgb(205, 205, 205);
            margin:6px 10px;
            width: fit-content;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            border:none;
            border-radius:6px;
            color:rgb(41, 41, 41);
            font-size: 14px;
            font-weight: 500;
        }

        .doc-button:hover{
            background-color: rgb(63, 115, 211);
        }

        #links-directos-form-container{
            position:fixed;
            top:0;
            left:0;
            display:flex;
            align-items:center;
            justify-content: center;
            width:100vw;
            height: 100vh;
            background-color:rgba(0, 0, 0, 0.193);
            margin:0;
        }

        .links-directos-form-window{
            color:rgb(255, 255, 255);
            width: 400px;
            background-color:#1d2839;
            border-radius: 8px;
            text-align: center;
            padding:10px 15px;
        }

    </style>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th class="table-title"></th>
                            <th style="width:25%;">Descripcion</th>
                            <th class="table-title">link</th>
                            <th class="table-title"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($linksList as $url)
                            <tr>
                                <td class="text-center">
                                    <button wire:click="eliminarUrl({{$url['id']}})"class="btn btn-ghost-light p-2">
                                        <img src="{{ asset('svg/delete.svg') }}" alt="delete">
                                    </button>
                                    <button wire:click="handleForm('editar',{{$url}})" class="btn btn-ghost-light ms-0 p-2">
                                        <img src="{{ asset('svg/edit.svg') }}" alt="edit">
                                    </button>
                                </td>
                                <td>{{$url['descripcion']}}</td>
                                <td><div style="padding:5px 8px; border-radius:6px;background-color:rgba(0, 0, 0, 0.09);max-width:fit-content">{{'doconlineargentina.com/turnero/login?redirect=' . $url['uri']}}</div></td>
                                <td><button class="doc-button" onclick="copiarAlPortapapeles('{{'doconlineargentina.com/turnero/login?redirect=' . $url['uri']}}')">Copiar</button></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


        @if($showForm)
        <div id="links-directos-form-container">
            <div class="links-directos-form-window">

                @if($idSeleccionado !== 0)
                    <h3 class="mt-2 mb-3">Editar Link</h3>
                @else
                    <h3 class="mt-2 mb-3">Agregar Link</h3>
                @endif

                <label class="w-full text-start px-1">Descripcion:</label>
                <input placeholder="Descripción" class="form-control my-2 mb-4" wire:model.lazy='descripcion'/>
                @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror

                <label class="w-full text-start px-1">URI:</label>
                <input placeholder="URI" class="form-control my-2 mb-3" wire:model.lazy='uri'/>
                @error('url')<div class="text-danger">{{ $message }}</div>@enderror

                <button class="btn btn-primary" wire:click="submit" style="margin:10px 6px;">Guardar</button>
                <button class="btn btn-primary" wire:click="hiddenForm" style="margin:10px 6px;background-color:rgb(225, 225, 225);color:black;">Cancelar</button>
            </div>
        </div>
        @endif
</div>

@push('scripts')
<script type="text/javascript">

    function copiarAlPortapapeles(texto) {
            navigator.clipboard.writeText(texto)
            .then(Livewire.emit('copiadoAlPortapapeles'))
            .catch((error) => {
                console.error('Error al copiar al portapapeles: ', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', itemId => {
                Swal.fire({
                    title: 'Está Seguro?',
                    text: 'Se eliminará el Beneficio',
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

        document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('copiarLink', link => {
            navigator.clipboard.writeText(link)
                .then(() => {})
                .catch(error => {
                    console.error('Error al copiar al portapapeles: ', error);
                    // Manejar el error, si es necesario
                });
        });
    });


    document.getElementById('agregarBtn').addEventListener('click', function() {
        console.log('click');
        Livewire.emit('handleAgregar');
    });





</script>

@endpush
