<div class="max-w-7xl mx-auto p-6 rounded-md bg-white mt-10">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize block w-full text-center">
                Generacion de Stickers
            </h2>
            <a href="{{ route('admin.stickers.equipo') }}"
                class="ml-auto bg-green-600 text-sm text-white px-4 py-2 rounded-md block w-full text-center">
                Cambio Stickers Equipo
            </a>
            <a href="{{ route('admin.stickers.status') }}"
                class="ml-auto bg-blue-500 text-sm text-white px-4 py-2 rounded-md block w-full text-center">
                Cambio Stickers Estado
            </a>
            <a href="{{ route('admin.stickers.listar') }}"
                class="ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md block w-full text-center">
                Listado de Stickers
            </a>
        </div>
    </x-slot>
    <div class="py-10 px-4 rounded-md bg-white">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto">
            <div class="mb-4 w-56 mx-auto">
                <x-label value="Inicio" />
                <x-input type="number" wire:model="inicio" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de inicio" />
                <x-input-error for="inicio" />
            </div>
            <div class="mb-4 w-56 mx-auto">
                <x-label value="Fin" />
                <x-input type="number" wire:model="fin" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de fin" />
                <x-input-error for="fin" />
            </div>
            <div class="mb-4 relative mx-auto w-56">
                <x-label value="Equipo" />
                <div>
                    <input class="rounded-md border border-gray-300 w-56" wire:model.live.debounce.500ms="search" type="text"
                        placeholder="Buscar Equipos Ejm C4G01">
                    @if ($equipments && $equipments->count())
                        <div class="absolute w-56 mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                            :class="{ 'hidden': !$wire.open }" x-on:click.away="$wire.open = false">
                            <ul>
                                @foreach ($equipments as $equipment)
                                    <li x-on:click.away="$wire.open = false"
                                        class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                        wire:click="seleccionarEquipo({{ $equipment->id }})">
                                        {{ $equipment->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-center">
                <p>Equipo seleccionado: <span
                        class="{{ $selectedEquipo ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                        {{ $selectedEquipo ? $selectedEquipo->name : 'Elegir un equipo' }}</span>
                </p>
            </div>
            @error('seleccionarEquipo')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-10 flex justify-center">
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
                Generar Stickers
            </x-button>
        </div>

        @if (session()->has('message'))
            <div class="w-auto mx-auto p-4 mt-6">
                @if (session('messageType') === 'success')
                    <div class="alert alert-success bg-green-500 text-white px-3 py-2 rounded-md text-center">
                        {{ session('message') }}
                    </div>
                @else
                    <div class="alert alert-danger bg-red-500 text-white px-3 py-2 rounded-md text-center">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
