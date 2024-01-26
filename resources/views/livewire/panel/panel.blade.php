<div class='card'>
    <style>
        .links-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 10px 15px;
        }

        .links-destacados .links-container{
            padding-top:0px;
        }

        .links-link{
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            cursor:pointer;
            margin:15px 0px;
            width: 120px;
            padding:10px;
            border-radius: 16px;
            color:white;
            min-height: 100px;
        }

        @keyframes effect{
            0%{
                opacity:0%;
                transform:translateY(10px);
            }
            100%{
                opacity:100%
                transform:translateY(0px);
            }
        }

        .links-link p{
            margin-bottom: 0;
        }

        .links-link button{
            visibility: hidden;
            border-radius: 50%;
            border:none;
            height: 20px;
            width: 20px;
            margin:0 5px;
            background-color:rgba(0, 0, 0, 0);
            opacity: 80%;
            margin-top: 10px;
        }

        .links-link button:hover{
            opacity: 100%;
        }

        .links-link button:hover img{
            width: 120%;
        }

        .links-buttons-eliminar{
            padding:0 !important;
        }

        .links-link:hover button{
            visibility: visible;
        }

        .links-link:focus{
            text-decoration: none;
            color:white;
        }

        .links-link:hover{
            text-decoration: none;
            background-color:rgba(255, 255, 255, 0.04);
            color:white;
        }

        .links-image{
            height:35px;
            margin-bottom: 7px;
        }

        .links-name{
            color:white;
            font-size:14.5px;
            text-align: center;
            max-width: 100%;
            pre-wrap: break-word;
        }

        .links-destacados{
            padding: 0px;
            padding-top:10px;
            border-bottom: 1px solid rgba(189, 189, 189, 0.092);
            padding-right: 10px;
            margin-bottom:15px;

        }

        .links-destacados .links-link{
            margin:15px 0;
        }

        .links-destacados .links-link p{
            font-size: 16px;
        }

        .links-destacados-title{
            font-size:16px;
            margin:10px;
            margin-bottom:0px;
            margin-left: 20px;
            display: inline;
        }

        .links-agregar{
            color:white;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.045);
            height: 90px;
            width: 90px;
            margin:14px 25px;
            border:none;
        }

        .links-agregar:hover{
            background-color: rgba(255, 255, 255, 0.093);
        }

        .links-agregar p{
            margin:0;
        }

        .links-form{
            position:fixed;
            top:0;
            left:0;
            display:flex;
            align-items:center;
            justify-content: center;
            width:100vw;
            height: 100vh;
            background-color:rgba(0, 0, 0, 0.193);
        }

        .links-form-window{
            color:rgb(255, 255, 255);
            width: 300px;
            background-color:#1d2839;
            border-radius: 8px;
            text-align: center;
            padding:10px 15px;
        }

        .links-form-window input{
            margin:20px 0;
        }

        .links-editar-boton{
            position:absolute;
            right: 10px;
            top:10px;
            height:26px;
            margin:0 !important;
            font-size:13px;
            border-radius:6px;
            font-weight:500;
        }

        @media only screen and (max-width:1000px){
            .links-link{
                width: 120px;
                margin: 15px;
            }
        }


        @media only screen and (max-width:600px){
            .links-link{
                width: 120px;
                margin: 15px 0;
            }
        }

        @media only screen and (max-width:470px){
            .links-link{
                width: 100px;
                margin: 15px 0;
            }
        }



    </style>

    @if(Auth::user()->esAdmin() || Auth::user()->esEditor())
       <button wire:click='switchEditar()' style="margin-right:10px" class="btn btn-primary float-sm-end links-editar-boton">@if(!$editar)Editar @else Listo @endif</button>
    @endif

    @if($destacadosCount > 0)
    <div class='links-destacados'>
        <h2 class='links-destacados-title'>Destacados</h2>
        <div class='links-container'>
            @foreach($urlList as $url)
                @if($url['destacado'] === 1 )
                <a @if(!$editar) href="{{$url['url']}}" target="_blank" @else wire:click="handleForm('editar',{{$url}})" @endif class="links-link">

                    <img onerror="this.src='{{ asset('https://www.pngmart.com/files/23/Link-Icon-PNG-File.png') }}'" class="links-image"
                    @if($url['image'] === null) src="https://www.pngmart.com/files/23/Link-Icon-PNG-File.png"  @else src="{{$url['image']}}"@endif/>

                    <p class="links-name">{{$url['nombre']}}</p>
                    @if($editar)
                        <div class="links-buttons">
                            <button wire:click.stop="eliminarUrl({{$url['id']}});"  class="links-buttons-eliminar"><img src="https://cdn.icon-icons.com/icons2/1154/PNG/96/1486564399-close_81512.png"/></button>
                        </div>
                    @endif
                </a>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <div class="links-container">
        @if($editar)
            <button wire:click="handleForm('agregar','')" href="google.com" class="links-link links-agregar">
                <p>Agregar</p>
                <p style="font-size: 26px">+</p>
            </button>
        @endif

        @foreach($urlList as $url)
            @if($url['destacado'] === 0 )
                <a @if(!$editar)  href="{{$url['url']}}" target="_blank" @else wire:click="handleForm('editar',{{$url}})" @endif class="links-link">

                    <img  onerror="this.src='{{ asset('/img/link-icon.png') }}'" class="links-image"
                    @if($url['image'] === null) src="{{ asset('/img/link-icon.png') }}"  @else src="{{$url['image']}}"@endif/>

                    <p class="links-name">{{$url['nombre']}}</p>
                    @if($editar)
                        <div class="links-buttons">
                            <button wire:click.stop="eliminarUrl({{$url['id']}});" class="links-buttons-eliminar"><img src="https://cdn.icon-icons.com/icons2/1154/PNG/96/1486564399-close_81512.png"/></button>
                        </div>
                    @endif
                </a>
            @endIf
        @endforeach
    </div>

    @if($showForm)
    <div class="links-form">
        <div class="links-form-window">
            @if ($idSeleccionado !== 0)
                <h3 class="mt-2 mb-2">Editar Link</h3>
            @else
                <h3 class="mt-2 mb-2">Agregar Link</h3>
            @endif
            <input placeholder="Nombre" class="form-control" wire:model.lazy='nombre'/>
            @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror

            <input placeholder="URL" class="form-control" wire:model.lazy='url'/>
            @error('url')<div class="text-danger">{{ $message }}</div>@enderror

            <input placeholder="URL de la imagen (opcional)" class="form-control" wire:model.lazy='image'/>
            <div style="display:flex;flex-direction:row;align-items:center;">
                <input placeholder="URL" class="form-check-input" type="checkbox"  wire:model.lazy='destacado'/>
                <span style="margin-left:10px" class="form-check-label">Destacado</span>
            </div>
            <button wire:click="submit()" class="btn btn-primary" style="margin:10px 6px;">Guardar</button>
            <button class="btn btn-primary" wire:click="hiddenForm" style="margin:10px 6px;background-color:rgb(225, 225, 225);color:black;">Cancelar</button>
        </div>
    </div>
    @endif
</div>
