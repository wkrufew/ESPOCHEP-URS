<section class="max-w-6xl mx-auto px-4 py-10">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Listado de Coberturas
        </h2>
        <a href="{{ route('encuestador.coberturas.create') }}"
            class="ml-auto bg-gray-900 text-sm text-white px-4 py-2 rounded-md">
            Crear Cobertura
        </a>
    </x-slot>

    <div class="mb-4 flex flex-col md:flex-row w-full md:space-x-6">
        <div class="w-full md:w-1/2">
            <x-label value="Buscar por Fecha de Cobertura" />
            <x-input type="date" wire:model.live.debounce.500ms="search" class="w-full"
                placeholder="Ingrese la fecha..." />
        </div>
        <div class="w-full md:w-1/2">
            <x-label value="Buscar por Certificado/Sticker" />
            <x-input type="text" wire:model.live.debounce.500ms="search" class="w-full"
                placeholder="Ingrese el certificado/Sticker..." />
        </div>
    </div>

    <div class="relative overflow-x-auto">
        @if ($coberturas->count())
            <table class="w-full divide-y divide-gray-200 rounded-md table">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Dia
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider{{--  hidden md:table-cell --}}">
                            CODIGO C/S
                        </th>
                        {{-- <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Sticker
                        </th> --}}
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Estado de Encuesta
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Planificacion/Sector
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                            Fecha Registro
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($coberturas as $worker)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-900">
                                    {{ \Carbon\Carbon::parse($worker->fecha_encuesta)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-xs text-gray-900">
                                    {{ $worker->dia }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap {{-- hidden md:table-cell --}}">
                                <div class="text-xs text-gray-900">
                                    @if (isset($worker->certificado->code))
                                        <span class="font-semibold">C: </span> {{ optional($worker->certificado)->code }}
                                    @endif <br>
                                    @if (isset($worker->sticker->code))
                                        <span class="font-semibold">S: </span> {{ optional($worker->sticker)->code }}
                                    @endif
                                </div>
                            </td>

                            {{-- <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-sm text-gray-900">
                                    {{ optional($worker->sticker)->code }}
                                </div>
                            </td> --}}

                            @if ($worker->efectivas)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Efectiva
                                    </div>
                                </td>
                            @elseIf($worker->temporal)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Temporal
                                    </div>
                                </td>
                            @elseIf($worker->nadie_en_casa)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Nadie en casa
                                    </div>
                                </td>
                            @elseIf($worker->construccion)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Construccion
                                    </div>
                                </td>
                            @elseIf($worker->destruida)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Destruida
                                    </div>
                                </td>
                            @elseIf($worker->desocupada)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Desocupada
                                    </div>
                                </td>
                            @elseIf($worker->rechazo)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Rechazo
                                    </div>
                                </td>
                            @elseIf($worker->informante_no_calificado)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">
                                        Informante no calificado
                                    </div>
                                </td>
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-xs text-gray-900 text-center">
                                    {{ $worker->planning->code }} <br>
                                    {{$worker->planning->codigo_manzana}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-xs text-gray-900">
                                    {{ 'Creado: ' . $worker->created_at }} <br>
                                    {{ 'Actualizado: ' . $worker->updated_at }}
                                </div>
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    <a class="bg-blue-500 rounded-full p-2 inline-block" href="{{route('encuestador.coberturas.edit', $worker)}}">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                                    </a>
                                </div>
                            </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @php
                                        // Calcula la diferencia de tiempo en minutos entre la fecha actual y created_at
                                        $createdAt = \Carbon\Carbon::parse($worker->created_at);
                                        $now = \Carbon\Carbon::now();
                                        $diffMinutes = $now->diffInMinutes($createdAt);
                                    @endphp

                                    {{-- Muestra el botón solo si la diferencia es menor o igual a 24 horas --}}
                                    @if ($diffMinutes <= 24 * 60)
                                        <a class="bg-blue-500 rounded-full p-2 inline-block"
                                            href="{{ route('encuestador.coberturas.edit', $worker) }}">
                                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                                            </svg>
                                        </a>
                                    @endif
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
    @if ($coberturas->hasPages())
        <div class="px-6 py-4">
            {{ $coberturas->links() }}
        </div>
    @endif
</section>
