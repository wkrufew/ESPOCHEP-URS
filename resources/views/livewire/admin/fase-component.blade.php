<div class="max-w-7xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    {{-- Agregar departamento --}}
    <x-form-section submit="save" class="mb-6">

        <x-slot name="title">
            Agregar una nueva fase
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder agregar una nueva fase
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6{{--  sm:col-span-3 --}}">
                <x-label>
                    Nombre
                </x-label>

                <x-input wire:model="createForm.name" type="number" class="w-full mt-1" />

                <x-input-error for="createForm.name" />
            </div>
            <div class="flex col-span-6 justify-around">
                <div class="col-span-3">
                    <x-label>
                        Fecha Inicio
                    </x-label>
    
                    <x-input wire:model.live="createForm.fecha_inicio" type="date" class="w-full mt-1" />
    
                    <x-input-error for="createForm.fecha_inicio" />
                </div>
                <div class="col-span-3">
                    <x-label>
                        Fecha fin
                    </x-label>
    
                    <x-input wire:model="createForm.fecha_fin" type="date"  class="w-full mt-1" />
    
                    <x-input-error for="createForm.fecha_fin" />
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">

            <x-action-message class="mr-3" on="saved">
                Fase agregada.
            </x-action-message>

            <x-button class="mx-auto">
                Agregar
            </x-button>
        </x-slot>
    </x-form-section>

    {{-- Mostrar Departamentos --}}
    <x-action-section>
        <x-slot name="title">
            Lista de fases
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas las fases agregadas
        </x-slot>

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Codigo</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($phases as $phase)
                        <tr>
                            <td class="py-2">
                                {{$phase->name}} - {{ \Carbon\Carbon::parse($phase->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($phase->fecha_fin)->format('d/m/Y') }} 
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$phase}})">Editar</a>
                                    {{-- <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$dispatch('deletePhase', {{$phase->id}})">Eliminar</a> --}}
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </x-slot>
    </x-action-section>

    {{-- Modal editar --}}
    <x-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Fase
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
                <div>
                    <x-label>
                        Codigo
                    </x-label>
                    <x-input wire:model="editForm.name" type="text" class="w-full mt-1" />
                    <x-input-error for="editForm.name" />
                </div>
                <div class="flex justify-around">
                    <div>
                        <x-label>
                            Fecha Inicio
                        </x-label>
                        <x-input wire:model="editForm.fecha_inicio" type="date" class="w-full mt-1" />
                        <x-input-error for="editForm.fecha_inicio" />
                    </div>
                    <div>
                        <x-label>
                            Fecha Fin
                        </x-label>
                        <x-input wire:model="editForm.fecha_fin" type="date" class="w-full mt-1" />
                        <x-input-error for="editForm.fecha_fin" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deletePhase', phaseId => {
            
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Desea eliminar esta fase!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar esto!',
                    cancelButtonText: 'No!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.dispatch('phase-delete',  {phase: phaseId} )

                        Swal.fire(
                            'Eliminado!',
                            'Su registro fue eliminado correctamente.',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>