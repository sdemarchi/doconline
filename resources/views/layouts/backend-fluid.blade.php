<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta4
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <title>DocOnline Argentina</title>
    <!-- CSS files -->
    <link href="{{ URL::asset('/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('/css/stilod.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="icon" href=https://doconlineargentina.com/turnero/assets/favicon-2345e915.png" type="image/png">
    <style>
      .select2-container--default .select2-selection--single{
          background-color: #000;
      }
      .select2-search--dropdown{
      background-color: #000;
      }
      .select2-search__field{
          background-color: #000;
      }
            .select2-results {
          background-color: #000;
      }
    </style>
		@livewireStyles
  </head>
  <body class="antialiased theme-dark">
    <div class="wrapper">

        <div style="margin-bottom:20px;">
            <x-header />
            <x-navigation />
        </div>

      <div class="page-wrapper">

        <div class="container-fluid">
          <div class="page-header d-print-none">
            {{ $header }}
          </div>
        </div>

        <div class="page-body">
            <div class="container-fluid" style="padding-right:0 !important; padding-left:0; overflow-x:hidden;">
              <div class="row row-deck row-cards" style="max-width:100vw;overflow-x:scroll; padding-left:20px; padding-right:20px; padding-bottom:15px !important;">
                  {{ $slot }}
              </div>
            </div>
          </div>

        <x-footer />

      </div>
    </div>

    <!-- Template Core -->
    <script src="{{ URL::asset('/js/tabler.min.js') }}"></script>
    <!--     <script src="{{ URL::asset('/libs/jquery/jquery.min.js')}}"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
