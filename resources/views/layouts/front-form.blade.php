<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Doconline Argentina | Turnos Online</title>
    <!-- CSS files -->
    <link href="{{ URL::asset('/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/turnero.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">

    <link rel="icon" href=https://doconlineargentina.com/turnero/assets/favicon-2345e915.png" type="image/png">
    @livewireStyles
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">

    {{ $slot }}

    <a href="https://wa.me/3425319488" target="_blank">
      <img src="{{ URL::asset('img/logo-whatsapp.svg.webp') }}" width="70"
      style="position: absolute; bottom:30px; right:55px"/>
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ URL::asset('/js/tabler.min.js') }}"></script>
    <script src="{{ URL::asset('/js/flashcanvas.js') }}"></script>
    <script src="{{ URL::asset('/js/jSignature.min.js') }}"></script>

    @livewireScripts

    <script type="text/javascript">

      window.addEventListener('alert', event => {
          toastr[event.detail.type](event.detail.message,
          event.detail.title ?? ''), toastr.options = {
                  "closeButton": true,
                  "positionClass": "toast-bottom-right",

              }
          });
    </script>

    @stack('scripts')
  </body>
</html>
