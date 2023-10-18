<div>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Listado de Asignaciones
                </h1>

                <a class= "ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md" href="{{route('admin.asignaciones.create')}}">
                    Agregar Asignacion
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div>
            <div class="px-6 py-4">
                <x-input type="text" 
                    wire:model.live="search" 
                    class="w-full"
                    placeholder="Ingrese la fecha de asignacion que quiere buscar" />
            </div>

            @if ($asignaciones->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Codigo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Equipo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Planificacion
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($asignaciones as $assignment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $assignment->code }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $assignment->equipment->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $assignment->planning->code }} -
                                        {{\Carbon\Carbon::parse($assignment->planning->fecha_inicio)->format('d/m/Y') }} -
                                        {{\Carbon\Carbon::parse($assignment->planning->fecha_fin)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($assignment->status)
                                        @case(0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                            </span>
                                        @break
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @break
                                        @default

                                    @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.asignaciones.edit', $assignment) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>

                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>

            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif

            @if ($asignaciones->hasPages())
                
                <div class="px-6 py-4">
                    {{ $asignaciones->links() }}
                </div>
                
            @endif
                

        </div>
    </div>

</div>