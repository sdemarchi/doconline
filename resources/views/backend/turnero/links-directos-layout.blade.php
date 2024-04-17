<x-backend-layout>
    <x-slot name="header">
        <div style="max-height:fit-content;width:100%;font-size:18px;display:flex;justify-content:space-between;">
            <p style="font-weight:600 !important;max-width:fit-content" class="font-semibold text-xl text-gray-800 my-0 py-0">
                Links Directos
            </p >
            <button id="agregarBtn" class="btn btn-primary float-sm-end my-0" style='font-size:15px;padding: 4px 10px;'>Agregar</button>
        </div>
    </x-slot>

    <div style="width:auto !important; max-width:none !important;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg" style="border-radius:5px;">
                <div class="p-6 border-b border-gray-200">
                    <livewire:turnero.backend.links-directos />
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
    </x-slot>
</x-backend-layout>
