<x-backend-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Turnos
                </h2>
            </div>
            <!--<div class="col-sm-6">
                <a href="{{ route('turnos.create') }}" class="btn btn-primary float-sm-end">Nuevo Turno</a>
            </div>-->
        </div>
    </x-slot>

    <div class="py-12" style="width:auto !important; max-width:none !important;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                   <livewire:turnero.backend.turnos-list/>
                </div>
            </div>
        </div>
    </div>



</x-backend-layout>
