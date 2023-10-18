<div>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Planificacion
                </h1>
                <x-danger-button wire:click="$dispatch('deletePlanning', {{$planning->id}})">
                    Eliminar
                </x-danger-button>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <h1 class="text-xl text-center font-semibold mb-4">FORMULARIO PARA EDITAR UNA PLANIFICACION</h1>

        <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
            <p class="text-2xl text-center font-semibold mb-2">Estado de la Planificacion</p>
            <div class="flex justify-between">
                <label class="mr-6">
                    <input wire:model="status" type="radio" name="status" value="0">
                    Planificacion en Inactiva
                </label>
                <label>
                    <input wire:model="status" type="radio" name="status" value="1">
                    Planificacion Activa
                </label>
                <label>
                    <input wire:model="status" type="radio" name="status" value="2">
                    Planificacion Cerrada
                </label>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-5 gap-6 mb-4">
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

            <div class="flex justify-center items-center mt-4">
                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>
                <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
                    Actualizar Planificacion
                </x-button>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            Livewire.on('deletePlanning', planningId => {

                Swal.fire({
                    title: 'Deseas eliminar esta planificacion?',
                    text: "Se eliminara de manera permanente de la base de datos!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar esto!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.dispatch('planificacion-delete', {planning: planningId});
                        
                        /* Swal.fire(
                            'Eliminado!',
                            'Su planificacion fue eliminada.',
                            'Exitoso'
                        ) */
                    }
                })

            })
        </script>
    @endpush
</div>
