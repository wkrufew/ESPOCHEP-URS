<div>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Listado de Planificaciones
                </h1>

                <a class="ml-auto bg-green-600 text-sm text-white px-4 py-2 rounded-md flex items-center"
                    href="{{ route('admin.planificaciones.import') }}">
                    <span>
                        <svg class="fill-white mr-2 text-lg" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z"/></svg>
                    </span>
                    Importar Planificacion
                </a>
                <a class="ml-auto bg-blue-600 text-sm text-white px-4 py-2 rounded-md flex items-center"
                    href="{{ route('admin.planificaciones-status.index') }}">
                    Estados de Planificacion
                </a>

                <a class="ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md"
                    href="{{ route('admin.planificaciones.create') }}">
                    Agregar Planificacion
                </a>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4">
        <div>
            <div class="px-6 py-4">
                <x-input type="text" wire:model.live.debounce.500ms="search" class="w-full"
                    placeholder="Ingrese el codigo de la planificacion que quiere buscar" />
            </div>
            @if (session('success'))
                <div>
                    <p class="py-2 px-4 rounded-md text-white bg-green-500"> {{ session('success') }}</p>
                </div>
            @endif
            @if ($planificaciones->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Codigo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fase
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Equipo
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Provincia
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Canton
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Parroquia
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                COD. Sector / Manzana
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hogares
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha Intervencion
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
                        @foreach ($planificaciones as $planificacion)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->code }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->phase->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->equipment->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->provincia }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->canton }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->parroquia }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->codigo_manzana }} <br>
                                        @switch($planificacion->tipo_sector)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Amanzanado
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disperso
                                            </span>
                                        @break

                                        @default
                                    @endswitch
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ $planificacion->hogares_planificados }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        {{ \Carbon\Carbon::parse($planificacion->fecha_inicio)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($planificacion->fecha_fin)->format('d/m/Y') }}
                                        <br> Dias: {{ $planificacion->dias }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($planificacion->status)
                                        @case(0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactivo
                                            </span>
                                        @break

                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Activo
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Cerrado
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.planificaciones.edit', $planificacion) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td> --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a class="bg-blue-500 rounded-full p-2 inline-block" title="Configuracion"
                                        href="{{ route('admin.planificaciones.edit', $planificacion) }}">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                                        </svg>
                                    </a>
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

            @if ($planificaciones->hasPages())
                <div class="px-6 py-4">
                    {{ $planificaciones->links() }}
                </div>
            @endif


        </div>
    </div>

</div>
