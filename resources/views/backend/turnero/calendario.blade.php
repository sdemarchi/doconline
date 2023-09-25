<x-backend-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calendario de Turnos
        </h2>
    </x-slot>

    <div class="py-12" style="width:auto !important; max-width:none !important;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b sm:rounded-lg border-gray-200">
                   <livewire:turnero.backend.calendario/>
                </div>
            </div>
        </div>
    </div>



</x-backend-layout>
