<x-backend-fluid-layout>
    <x-slot name="header">
        <div class="row">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Pacientes del Turnero
                </h2>


        </div>
    </x-slot>

    <div class="py-12" style="width:auto !important; max-width:none !important;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                   <livewire:turnero.backend.turno-pacientes/>
                </div>
            </div>
        </div>
    </div>



</x-backend-fluid-layout>
