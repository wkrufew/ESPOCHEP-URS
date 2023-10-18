<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <h1 class="text-lg text-center font-semibold mb-4">Complete esta información para crear una nueva planificacion</h1>

    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-4">
        {{-- Fases --}}
        <div>
            <x-label value="Fase" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="phase_id">
                <option value="" selected disabled>Seleccione una fase</option>
                @foreach ($fases as $fase)
                    <option value="{{ $fase->id }}">{{ $fase->name }}</option>
                @endforeach
            </select>
            <x-input-error for="phase_id" />
        </div>
        {{-- Equipos --}}
        <div>
            <x-label value="Equipo" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="equipment_id">
                <option value="" selected disabled>Seleccione una provincia</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
                @endforeach
            </select>
            <x-input-error for="equipment_id" />
        </div>
        {{-- Provincia --}}
        <div>
            <x-label value="Provincia" />
            <x-input type="text" wire:model="provincia" class="w-full"
                placeholder="Ingrese el nombre de la provincia" />

            <x-input-error for="provincia" />
        </div>

        {{-- Canton --}}
        <div>
            <x-label value="Canton" />
            <x-input type="text" wire:model="canton" class="w-full"
                placeholder="Ingrese el canton" />

            <x-input-error for="canton" />
        </div>
        {{-- Parroquia --}}
        <div>
            <x-label value="Parroquia" />
            <x-input type="text" wire:model="parroquia" class="w-full"
                placeholder="Ingrese la parroquia" />

            <x-input-error for="parroquia" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
         {{-- DPA --}}
         <div>
            <x-label value="DPA" />
            <x-input type="text" wire:model="dpa" class="w-full"
                placeholder="Ingrese el DPA" />

            <x-input-error for="dpa" />
        </div>
        {{-- Area Censal --}}
        <div>
            <x-label value="Area Censal" />
            <x-input type="text" wire:model="areacensal" class="w-full"
                placeholder="Ingrese el Area Censal" />

            <x-input-error for="areacensal" />
        </div>
        <div>
            <x-label value="Codigo de Manzana" />
            <x-input type="text" wire:model="codigo_manzana" class="w-full"
                placeholder="Ingrese el codigo de manzana" />

            <x-input-error for="codigo_manzana" />
        </div>
        {{-- Tipo de Sector --}}
        <div>
            <x-label value="Tipo de Sector" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="tipo_sector">
                <option value="">Seleccione un tipo</option>
                <option value="1">Amanzanado</option>
                <option value="2">Disperso</option>
            </select>
            <x-input-error for="tipo_sector" />
        </div>
   
       
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        {{-- Hogares Planificados --}}
        <div class="mb-4">
            <x-label value="Hogares Planificados" />
            <x-input type="number" wire:model="hogares_planificados" class="w-full"
                placeholder="Ingrese el numero de hogares" />

            <x-input-error for="hogares_planificados" />
        </div>

        {{-- Fecha de Inicio --}}
        <div class="mb-4">
            <x-label value="Fecha de Inicio" />
            <x-input type="date" wire:model="fecha_inicio" class="w-full"
                placeholder="Fecha de Inicio" />

            <x-input-error for="fecha_inicio" />
        </div>

        {{-- Fecha de Fin --}}
        <div class="mb-4">
            <x-label value="Fecha de Fin" />
            <x-input type="date" wire:model="fecha_fin" class="w-full"
                placeholder="Fecha de Fin" />

            <x-input-error for="fecha_fin" />
        </div>

        {{-- Dias --}}
        <div class="mb-4">
            <x-label value="Dias" />
            <x-input type="number" wire:model="dias" class="w-full" placeholder="Ingrese numero de dias" />
            <x-input-error for="dias" />
        </div>
    </div>

    <div class="mt-10 flex justify-center">
        <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
            Crear Planificacion
        </x-button>
    </div>
</div>
