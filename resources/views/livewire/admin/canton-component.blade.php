<div class="max-w-7xl mx-auto">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Canton: {{$canton->name}}
        </h2>
    </x-slot>

    <div class="contenedor py-6">
        {{-- Agregar distrito --}}
        <x-form-section submit="save" class="mb-6">
    
            <x-slot name="title">
                Agregar una nueva parroquia
            </x-slot>
    
            <x-slot name="description">
                Complete la información necesaria para poder agregar un nueva parroquia
            </x-slot>
    
            <x-slot name="form">
                <div class="col-span-6 sm:col-span-3">
                    <x-label>
                        Nombre
                    </x-label>
    
                    <x-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
    
                    <x-input-error for="createForm.name" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-label>
                        Codigo
                    </x-label>
    
                    <x-input wire:model.defer="createForm.code" type="text" class="w-full mt-1" />
    
                    <x-input-error for="createForm.code" />
                </div>

            </x-slot>
    
            <x-slot name="actions">
    
                <x-action-message class="mr-3" on="saved">
                    parroquia agregada
                </x-action-message>
    
                <x-button class="mx-auto">
                    Agregar
                </x-button>
            </x-slot>
        </x-form-section>
    
        {{-- Mostrar Departamentos --}}
        <x-action-section>
            <x-slot name="title">
                Lista de parroquias
            </x-slot>
    
            <x-slot name="description">
                Aquí encontrará todas las parroquias agregados
            </x-slot>
    
            <x-slot name="content">
    
                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>
    
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($parishes as $parish)
                            <tr>
                                <td class="py-2">
                                    {{$parish->name}}
                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$parish}})">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$dispatch('deleteParroquia', {{$parish->id}})">Eliminar</a>
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
                Editar Parroquia
            </x-slot>
    
            <x-slot name="content">
    
                <div class="space-y-3">
                   
                    <div>
                        <x-label>
                            Nombre
                        </x-label>
    
                        <x-input wire:model="editForm.name" type="text" class="w-full mt-1" />
    
                        <x-input-error for="editForm.name" />
                    </div>

                    <div>
                        <x-label>
                            Codigo
                        </x-label>
    
                        <x-input wire:model="editForm.code" type="text" class="w-full mt-1" />
    
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
            Livewire.on('deleteParroquia', parroquiaId => {

                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Esta parroquia se eliminara permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar esto!',
                    cancelButtonText: 'No!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.dispatch('parish-delete',  {parish: parroquiaId} )

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