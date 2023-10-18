<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <h1 class="text-lg text-center font-semibold mb-4">Complete esta información para crear una nueva Asignacion</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        {{-- Equipos --}}
        <div>
            <x-label value="Equipos" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="equipment_id">
                <option value="" selected disabled>Seleccione un equipo</option>

                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
                @endforeach
            </select>

            <x-input-error for="equipment_id" />
        </div>

        {{-- Planificaciones --}}
        <div>
            <x-label value="Planificaciones" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="planning_id">
                <option value="" selected disabled>Seleccione una planificacion</option>

                @foreach ($planificaciones as $planificacion)
                    <option value="{{ $planificacion->id }}">{{ $planificacion->code }} - {{ \Carbon\Carbon::parse($planificacion->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($planificacion->fecha_fin)->format('d/m/Y') }}</option>
                @endforeach
            </select>

            <x-input-error for="planning_id" />
        </div>
    </div>

    <div class="mt-10 flex justify-center">
        <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
            Crear Asignacion
        </x-button>
    </div>
</div>
