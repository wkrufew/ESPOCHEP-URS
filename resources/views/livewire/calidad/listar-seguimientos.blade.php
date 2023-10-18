<div class="max-w-6xl mx-auto px-4 py-10">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between w-full">
            <div>
                <h2 class="font-semibold md:text-xl text-gray-800 leading-tight capitalize text-center">
                    Listado de Seguimientos y Supervisiones
                </h2>
            </div>
            <a href="{{ route('calidad.seguimientos.create') }}"
                class="md:ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md flex justify-center mt-4 md:mt-0">
                Crear Registro
            </a>
        </div>
    </x-slot>

    <div class="mb-4 flex flex-col md:flex-row w-full md:space-x-6">
        <div class="w-full md:w-1/2">
            <x-label value="Buscar por Fecha de Cobertura" />
            <x-input type="date" wire:model.live.debounce.500ms="search" class="w-full"
                placeholder="Ingrese la fecha..." />
        </div>
        <div class="w-full md:w-1/2">
            <x-label value="Buscar por Certificado" />
            <x-input type="text" wire:model.live.debounce.500ms="search" class="w-full"
                placeholder="Ingrese el certificado..." />
        </div>
    </div>

    <div>
        @if ($seguimientos->count())
            <table class="min-w-full divide-y divide-gray-200 overflow-hidden rounded-md">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{-- hidden md:table-cell --}}">
                            Planificacion/Sector
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Fase
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha Encuesta
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Certificado
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Supervisor
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Fecha Registro
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($seguimientos as $seguimiento)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-sm text-gray-900">
                                    {{ $seguimiento->planning->code }} <br>
                                    {{ $seguimiento->planning->codigo_manzana }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-sm text-gray-900">
                                    {{ $seguimiento->planning->phase->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($seguimiento->fecha_seguimiento)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $seguimiento->tipo }} <br>
                                    <span class="font-semibold">C: </span> {{ optional($seguimiento->certificado)->code }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-sm text-gray-900">
                                    {{ optional($seguimiento->certificado)->code }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-sm text-gray-900">
                                    {{ $seguimiento->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-xs text-gray-900">
                                    {{ 'Creado: ' . $seguimiento->created_at }} <br>
                                    {{ 'Actualizado: ' . $seguimiento->updated_at }}
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
    @if ($seguimientos->hasPages())
        <div class="px-6 py-4">
            {{ $seguimientos->links() }}
        </div>
    @endif
</div>
