
<x-backend-fluid-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Pacientes / Estadisticas
        </h2>
    </x-slot>

    <div class="pb-12" style="width:auto !important; max-width:none !important;margin:none !important;">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <livewire:pacientes-estadisticas/>
        </div>
    </div>

</x-backend-fluid-layout>