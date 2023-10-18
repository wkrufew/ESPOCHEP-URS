<div class="max-w-5xl mx-auto px-4 py-10">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Listado de Equipos
        </h2>
        <a href="{{route('admin.equipos.create')}}" class="ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md">
            Crear Equipos
        </a>
    </x-slot>
    <div class="mb-4">
        <x-label value="Buscar Equipo" />
        <x-input type="text" wire:model.live="search" class="w-full" placeholder="Ingrese el código del equipo" />
    </div>

    <div>
        @if ($equipos->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Codigo
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha Creacion
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($equipos as $equipo)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @switch($equipo->status)
                                        @case(0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Inactivo
                                            </span>
                                        @break
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Activo
                                            </span>
                                        @break
                                        @default
                                    @endswitch
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $equipo->created_at }}
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    @else
        <div class="px-6 py-4">
            No hay ningún registro coincidente
        </div>
    @endif
    </div>
    @if ($equipos->hasPages())
        <div class="px-6 py-4">
            {{ $equipos->links() }}
        </div>
    @endif

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
