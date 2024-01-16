<header class="navbar navbar-expand-md navbar-light d-print-none">
    <style>
        .header-log-button{
            border:none;
            border-radius:6px;
            font-size:14px;
            height:25px;
            display:flex;
            align-items:center;
            text-decoration:none;
            padding: 0 8px;
        }

        #header-items-container{
            display: flex;
            align-items:center;
        }

        .header-log-button:focus , .header-log-button:active{
            text-decoration: none;
        }

        #header-items-menu-logo{
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        @media only screen and (max-width: 1000px){
            #header-items-container{
                width:100%;
                justify-content: space-between;
            }

            #header-items-menu-logo{
                width: 70px;
                justify-content: space-between;

            }
            .header-cerrar-sesion{
                display: none;
            }

        }


    </style>
    <div class="container-fluid">
        <div id="header-items-container">
            <div id="header-items-menu-logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/favicon.png') }}" width="50" alt="DocOnline" class="navbar-brand-image">
                    </a>
                </h1>
            </div>
            @if(Auth::user()->ingresoActivo())
            <a class="btn-primary header-log-button" href="{{ route('usuarios.egreso') }}" >
                Registrar Egreso
            </a>
            @else
            <a class="btn-primary header-log-button"  href="{{ route('usuarios.ingreso') }}" >
                Registrar Ingreso
            </a>
            @endif
        </div>

        <div class="navbar-nav flex-row order-md-last header-cerrar-sesion">
            <div class="nav-item dropdown" >
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <div class="d-none d-xl-block ps-2">
                <div>{{ Auth::user()->name }}</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                <a class="dropdown-item" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                </svg>
                &nbsp;Cerrar Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            </div>
            </div>
        </div>
    </div>
</header>
