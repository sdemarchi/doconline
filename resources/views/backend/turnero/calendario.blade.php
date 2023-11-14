<x-backend-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calendario de Turnos
        </h2>
    </x-slot>

    <div class="py-10 pw-0" style="width:auto !important; max-width:none !important;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  style="background-color: rgba(0, 0, 0, 0) !important;">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgba(0, 0, 0, 0) !important;">
            <livewire:turnero.backend.calendario/>
        </div>
    </div>
</x-backend-layout>
