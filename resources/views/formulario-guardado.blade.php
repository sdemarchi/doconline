<x-frontend-layout>
    <x-slot name="header">
        
    </x-slot>
    <div class="page pt-5">
    <div class="container-tight container-login py-4">
      <div class="card card-md">
        <div class="card-body mb-4">
            <h2 class="text-center mb-4">Datos Guardados</h2>
            <h4 class="text-center">Los datos ingresados se guardaron con éxito</h4>
        </div>
      </div>
      <div class="form-footer text-center">
        <a class="btn btn-primary" href="{{ route('turnero.panel') }}">Volver al Inicio</a>
      </div>  
    </div>
  </div>
</x-frontend-layout>