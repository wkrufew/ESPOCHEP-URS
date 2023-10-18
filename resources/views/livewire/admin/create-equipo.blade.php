<div class="max-w-7xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Generacion de Equipos
        </h2>
    </x-slot>
    <div class="flex justify-center space-x-10">
        <div class="mb-4 w-56">
            <x-label value="Inicio" />
            <x-input type="number" wire:model="inicio" min="1" max="12" class="w-full" placeholder="Ingrese el valor de inicio" />
            <x-input-error for="inicio" />
        </div>
        <div class="mb-4 w-56">
            <x-label value="Fin" />
            <x-input type="number" wire:model="fin" min="1" max="12" class="w-full" placeholder="Ingrese el valor de finalizacion" />
            <x-input-error for="fin" />
        </div>
    </div>
    <div class="mt-10 flex justify-center">
        <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
            Crear Equipos
        </x-button>
    </div>
    {{-- <div class="mt-10 flex justify-center">
        @if (session()->has('message'))
                @if (strpos(session('message'), 'complet') !== false || strpos(session('message'), 'cero') !== false)
                    <p class="py-2 px-4 rounded-md text-white bg-yellow-500">{{ session('message') }}</p>
                @elseif (strpos(session('message'), 'existe') !== false)
                    <p class="py-2 px-4 rounded-md text-white bg-red-500">{{ session('message') }}</p>
                @else
                    <p class="py-2 px-4 rounded-md text-white bg-green-500">{{ session('message') }}</p>
                @endif
            </div>
        @endif
    </div> --}}
    <div class="mt-10 flex justify-center">
        @if ($mensaje)
            <p class="py-2 px-4 rounded-md text-white bg-gray-500">{{ $mensaje }}</p>
        @endif
    </div>
</div>
