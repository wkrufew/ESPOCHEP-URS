<div class="max-w-7xl mx-auto">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Zona: {{$zone->code}}
        </h2>
    </x-slot>

    <div class="contenedor py-12">
        {{-- Agregar departamento --}}
        <x-form-section submit="save" class="mb-6">
    
            <x-slot name="title">
                Agregar un nuevo sector
            </x-slot>
    
            <x-slot name="description">
                Complete la información necesaria para poder agregar un nuevo sector
            </x-slot>
    
            <x-slot name="form">
                <div class="col-span-6">
                    <x-label>
                        Codigo
                    </x-label>
    
                    <x-input wire:model.defer="createForm.code" type="number" class="w-full mt-1" />
    
                    <x-input-error for="createForm.code" />
                </div>
            </x-slot>
    
            <x-slot name="actions">
    
                <x-action-message class="mr-3" on="saved">
                    Sector agregado.
                </x-action-message>
    
                <x-button class="mx-auto">
                    Agregar
                </x-button>
            </x-slot>
        </x-form-section>
    
        {{-- Mostrar provincias --}}
        <x-action-section>
            <x-slot name="title">
                Listado de sectores
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todos los sectores agregados
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
                        @foreach ($sectors as $sector)
                            <tr>
                                <td class="py-2">
                                    {{$sector->code}}
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$sector}})">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$dispatch('deleteSector', {{$sector->id}})">Eliminar</a>
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
                Editar Sector
            </x-slot>
    
            <x-slot name="content">
    
                <div class="space-y-3">

                    <div>
                        <x-label>
                            Codigo
                        </x-label>
    
                        <x-input wire:model="editForm.code" type="number" class="w-full mt-1" />
    
                        <x-input-error for="editForm.code" />
                    </div>
                 
                </div>
            </x-slot>
    
            <x-slot name="footer">
                <x-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-danger-button>
            </x-slot>
    
        </x-dialog-modal>
    </div>

    @push('script')
        <script>
            Livewire.on('deleteSector', sectorId => {
            
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Este sector se eliminara permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar esto!',
                    cancelButtonText: 'No!',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.dispatch('sector-delete',  {sector: sectorId} )

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