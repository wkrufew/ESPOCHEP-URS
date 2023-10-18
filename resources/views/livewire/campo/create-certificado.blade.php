<div class="max-w-7xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-center md:justify-between w-full">
            <div class="flex justify-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
                    Generacion de certificados
                </h2>
            </div>
            <a href="{{route('campo.certificados.listados')}}" class="md:ml-auto bg-green-500 text-sm text-white px-4 py-2 rounded-md my-3 md:my-0 text-center">
                Listado Certificados
            </a>
            <a href="{{route('campo.certificados.status')}}" class="md:ml-auto bg-blue-500 text-sm text-white px-4 py-2 rounded-md text-center">
                Cambio Certificados Estado
            </a>
        </div>
    </x-slot>
    <div class="p-10 rounded-md bg-white">
        <div class="flex flex-col md:flex-row justify-center md:justify-between md:space-x-10">
            <div class="mb-4 w-full md:w-56">
                <x-label value="Inicio" />
                <x-input type="number" wire:model="inicio" min="7" max="7" class="w-full" placeholder="Ingrese el valor de inicio" />
                <x-input-error for="dias" />
            </div>
            <div class="mb-4 w-full md:w-56">
                <x-label value="Fin" />
                <x-input type="number" wire:model="fin" min="7" max="7" class="w-full" placeholder="Ingrese el valor de fin" />
                <x-input-error for="dias" />
            </div>
            <div class="mb-4 w-full md:w-56">
                <x-label value="Nombre del Equipo" />
                <div class="w-full border border-gray-300 rounded-md py-2 text-center bg-gray-200">
                    {{$nombreEquipo->equipment->name}}
                </div>
            </div>
        </div>
        <div class="mt-10 flex justify-center">
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
                Crear Serie
            </x-button>
        </div>

        @if (session()->has('message'))
            <div class="mt-10 flex justify-center p-4 bg-white rounded-md">
                @if (strpos(session('message'), 'complet') !== false || strpos(session('message'), 'cero') !== false)
                    <p class="py-2 px-4 rounded-md text-white bg-yellow-500">{{ session('message') }}</p>
                @elseif (strpos(session('message'), 'existe') !== false)
                    <p class="py-2 px-4 rounded-md text-white bg-red-500">{{ session('message') }}</p>
                @elseif (strpos(session('message'), 'asignados a otro equipo') !== false)  {{-- Agregamos esta condición --}}
                    <p class="py-2 px-4 rounded-md text-white bg-gray-800">{{ session('message') }}</p>  {{-- Cambiamos el color a azul --}}
                @else
                    <p class="py-2 px-4 rounded-md text-white bg-green-500">{{ session('message') }}</p>
                @endif
            </div>
        @endif
    </div>
</div>