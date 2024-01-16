<div class="navbar-expand-md">
    <style>
        .ingreso-button:hover{
            text-decoration:none;
        }

    </style>

    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Inicio
                </span>
              </a>
            </li>
            <li style="display:flex;align-items:center;">
                <a class="nav-link" href="{{ route('panel') }}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"   stroke-width="0.5" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5858 4.58579C13.3668 3.80474 14.6331 3.80474 15.4142 4.58579C16.1952 5.36683 16.1952 6.63316 15.4142 7.41421L12.4142 10.4142C11.6331 11.1953 10.3668 11.1953 9.58577 10.4142C9.19524 10.0237 8.56208 10.0237 8.17156 10.4142C7.78103 10.8047 7.78103 11.4379 8.17156 11.8284C9.73365 13.3905 12.2663 13.3905 13.8284 11.8284L16.8284 8.82843C18.3905 7.26633 18.3905 4.73367 16.8284 3.17157C15.2663 1.60948 12.7337 1.60948 11.1716 3.17157L9.67156 4.67157C9.28103 5.0621 9.28103 5.69526 9.67156 6.08579C10.0621 6.47631 10.6952 6.47631 11.0858 6.08579L12.5858 4.58579ZM7.58579 9.58579C8.36683 8.80474 9.63316 8.80474 10.4142 9.58579C10.8047 9.97631 11.4379 9.97631 11.8284 9.58579C12.219 9.19526 12.219 8.5621 11.8284 8.17157C10.2663 6.60948 7.73367 6.60948 6.17157 8.17157L3.17157 11.1716C1.60948 12.7337 1.60948 15.2663 3.17157 16.8284C4.73367 18.3905 7.26633 18.3905 8.82843 16.8284L10.3284 15.3284C10.719 14.9379 10.719 14.3047 10.3284 13.9142C9.9379 13.5237 9.30474 13.5237 8.91421 13.9142L7.41421 15.4142C6.63316 16.1953 5.36684 16.1953 4.58579 15.4142C3.80474 14.6332 3.80474 13.3668 4.58579 12.5858L7.58579 9.58579Z" fill="#CACACA"/>
                        </svg>

                    </span>
                    <span class="nav-link-title">
                        Links
                    </span>
                </a>
            </li>
            @if(Auth::user()->esAdmin() || Auth::user()->esEditor())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg></span>
                <span class="nav-link-title">
                  Pacientes
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('pacientes') }}">
                   Pacientes
                </a>
                <a class="dropdown-item" href="{{ route('recetas') }}">
                   Recetas
                </a>
                <a class="dropdown-item" href="{{ route('pacientes.estadisticas') }}">
                    Estadisticas
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cannabis" width="24" height="24" viewBox="0 0 24 24"  stroke-width="0.2" stroke="currentColor"  fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 20s0 -2 1 -3.5c-1.5 0 -2 -.5 -4 -1.5c0 0 1.839 -1.38 5 -1c-1.789 -.97 -3.279 -2.03 -5 -6c0 0 3.98 -.3 6.5 3.5c-2.284 -4.9 1.5 -9.5 1.5 -9.5c2.734 5.47 2.389 7.5 1.5 9.5c2.531 -3.77 6.5 -3.5 6.5 -3.5c-1.721 3.97 -3.211 5.03 -5 6c3.161 -.38 5 1 5 1c-2 1 -2.5 1.5 -4 1.5c1 1.5 1 3.5 1 3.5c-2 0 -4.438 -2.22 -5 -3c-.563 .78 -3 3 -5 3z"></path>
                    <path d="M12 22v-5"></path>
                 </svg>
	              </span>
                <span class="nav-link-title">
                  Grows
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('grows') }}" >
                  Grows
                </a>
                <a class="dropdown-item" href="{{ route('grows.estadisticas') }}" >
                  Estadisticas
                </a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="9" y1="6" x2="20" y2="6" /><line x1="9" y1="12" x2="20" y2="12" /><line x1="9" y1="18" x2="20" y2="18" /><line x1="5" y1="6" x2="5" y2="6.01" /><line x1="5" y1="12" x2="5" y2="12.01" /><line x1="5" y1="18" x2="5" y2="18.01" /></svg></span>
                </span>
                <span class="nav-link-title">
                  Tablas
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('beneficios') }}" >
                  Beneficios
                </a>
                <a class="dropdown-item" href="{{ route('datos-medico') }}" >
                  Datos Médico
                </a>
                <a class="dropdown-item" href="{{ route('diagnosticos') }}" >
                  Diagnósticos
                </a>
                <a class="dropdown-item" href="{{ route('dolencias') }}" >
                  Dolencias
                </a>
                <a class="dropdown-item" href="{{ route('justificaciones') }}" >
                  Justificaciones
                </a>
                <a class="dropdown-item" href="{{ route('modos-contacto') }}" >
                  Modos de Contacto
                </a>
                <a class="dropdown-item" href="{{ route('productos') }}" >
                  Productos
                </a>
                <a class="dropdown-item" href="{{ route('tratamientos') }}" >
                  Tratamientos
                </a>
                <a class="dropdown-item" href="{{ route('ocupaciones') }}" >
                  Ocupaciones
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg></span>
                <span class="nav-link-title">
                  Turnero
                </span>
              </a>

              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('turnos') }}" >
                  Lista
                </a>
                <a class="dropdown-item" href="{{ route('calendario') }}" >
                  Calendario
                </a>
                <a class="dropdown-item" href="{{ route('turnos.configuracion') }}" >
                  Configuración
                </a>
                <a class="dropdown-item" href="{{ route('turnos.pacientes') }}" >
                  Pacientes
                </a>
                <a class="dropdown-item" href="{{ route('turnos.cbu') }}" >
                  Lista de CBU
                </a>
                <a class="dropdown-item" href="{{ route('cupones') }}" >
                  Cupones de Descuento
                </a>
              </div>
            </li>
            @endif
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" /></svg></span>
                <span class="nav-link-title">
                  Sistema
                </span>
              </a>
              <div class="dropdown-menu">
                @if(Auth::user()->esAdmin() || Auth::user()->esEditor())
                <a class="dropdown-item" href="{{ route('configuracion') }}" >
                  Configuración
                </a>
                @endif
                @if(Auth::user()->esAdmin())
                <a class="dropdown-item" href="{{ route('usuarios') }}" >
                  Usuarios
                </a>
                <a class="dropdown-item" href="{{ route('usuarios.control-horario') }}" >
                  Control Horario
                </a>
                @endif
                @if(Auth::user()->ingresoActivo())
                  <a class="dropdown-item" href="{{ route('usuarios.egreso') }}" >
                    Registrar Egreso
                  </a>
                @else
                  <a class="dropdown-item" href="{{ route('usuarios.ingreso') }}" >
                    Registrar Ingreso
                  </a>
                @endif
                <a class="dropdown-item" href="{{ route('usuarios.mi-registro') }}" >
                   Mi Registro Horario
                </a>
              </div>
            </li>
         </ul>

        </div>
      </div>
    </div>
  </div>
