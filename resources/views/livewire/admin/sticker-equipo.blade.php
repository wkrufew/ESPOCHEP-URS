<div class="max-w-7xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-md">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight uppercase">Cambiar Asignación de
            Certificados</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 mt-10 gap-6">
            <div class="mb-4">
                <x-label value="Inicio" />
                <x-input type="number" wire:model="inicio" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de inicio" />
                <x-input-error for="inicio" />
            </div>
            <div class="mb-4">
                <x-label value="Fin" />
                <x-input type="number" wire:model="fin" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de fina" />
                <x-input-error for="fin" />
            </div>
            <div class="mb-4 relative mx-auto w-56">
                <x-label value="Equipo Actual" />
                <div>
                    <input class="rounded-md border border-gray-300" wire:model.live.debounce.500ms="search1" type="text"
                        placeholder="Buscar Equipos Ejm C4G01">
                    @if ($equipments1 && $equipments1->count())
                        <div class="absolute w-56 mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                            :class="{ 'hidden': !$wire.open1 }" x-on:click.away="$wire.open1 = false">
                            <ul>
                                @foreach ($equipments1 as $equipment)
                                    <li x-on:click.away="$wire.open1 = false"
                                        class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                        wire:click="seleccionarEquipo1({{ $equipment->id }})">
                                        {{ $equipment->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                    @endif
                </div>
            </div>
            <div class="mb-4 relative mx-auto w-56">
                <x-label value="Equipo Nuevo" />
                <div>
                    <input class="rounded-md border border-gray-300" wire:model.live.debounce.500ms="search2" type="text"
                        placeholder="Buscar Equipos Ejm C4G01">
                    @if ($equipments2 && $equipments2->count())
                        <div class="absolute w-56 mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                            :class="{ 'hidden': !$wire.open2 }" x-on:click.away="$wire.open2 = false">
                            <ul>
                                @foreach ($equipments2 as $equipment)
                                    <li x-on:click.away="$wire.open2 = false"
                                        class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                        wire:click="seleccionarEquipo2({{ $equipment->id }})">
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
        <div class="w-full flex justify-evenly">
            <div>
                <div class="flex justify-center">
                    <p>Equipo 1: <span
                            class="{{ $selectedEquipo1 ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                            {{ $selectedEquipo1 ? $selectedEquipo1->name : 'Elegir un equipo' }}</span>
                    </p>
                </div>
                @error('selectedEquipo1')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <div class="flex justify-center">
                    <p>Equipo 2: <span
                            class="{{ $selectedEquipo2 ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                            {{ $selectedEquipo2 ? $selectedEquipo2->name : 'Elegir un equipo' }}</span>
                    </p>
                </div>
                @error('selectedEquipo2')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <x-button wire:loading.attr="disabled" wire:target="cambiarAsignacion" wire:click="cambiarAsignacion">
                Cambiar Asignación
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
