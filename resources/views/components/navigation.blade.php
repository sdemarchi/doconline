<div class="navbar-expand-md">
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
            @if(Auth::user()->esAdmin() || Auth::user()->esEditor())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <!-- Download SVG icon from http://tabler-icons.io/i/users -->
	              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg></span>
                <span class="nav-link-title">
                  Pacientes
                </span>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('pacientes') }}" >
                  Pacientes
                </a>
                <a class="dropdown-item" href="{{ route('recetas') }}" >
                  Recetas
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cannabis" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
            
          
        </div>
      </div>
    </div>
  </div>