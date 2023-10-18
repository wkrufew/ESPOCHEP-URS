<div class="max-w-6xl mx-auto px-4 py-10">
    <div wire:loading>
        <x-loading message="Cargando datos..." />
    </div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between w-full">
            <div>
                <h2 class="font-semibold md:text-xl text-gray-800 leading-tight capitalize text-center">
                    Listado de Seguimientos y Supervisiones
                </h2>
            </div>
            <a href="{{ route('campo.seguimientos.create') }}"
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 text-center">
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
                                    <span class="font-semibold">C: </span>
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

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <a class="bg-blue-500 rounded-full p-2 inline-block"
                                        href="{{ route('campo.seguimientos.edit', $seguimiento) }}">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                                        </svg>
                                    </a>
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
{{-- 7633581  -  7633301 --}}
</div>
