<div class="max-w-full rounded-md bg-white mx-auto mt-2 p-3">
    <div>
        <div wire:loading>
            <x-loading message="Cargando datos..." />
        </div>
        <div class="mb-4 flex justify-center">
            <input class="border border-gray-300 rounded-md w-full" wire:model.live.debounce.500ms="search" type="text"
                placeholder="Buscar planificación por Código, provincia, cantón, parroquia, equipo, o codigo de sector..." class="form-input">
            <select class="ml-3 border border-gray-300 rounded-md" name="" id="" wire:model.live="fase">
                <option value="" disabled>Seleccione una fase</option>
                @foreach ($fases as $fase)
                    <option value="{{$fase->id}}">{{$fase->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="overflow-x-auto touch-pan-x shadow-lg">
            <div class="rounded-md border border-sky-500 w-full overflow-x-scroll md:overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 rounded-b-md p-1">
                    <caption class="caption-top">
                        Tabla General: Cobertura acumulada por sectores de toda la planificacion
                      </caption>
                    <thead class="bg-sky-500">
                        <tr class="text-sm">
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Equipo</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Provincia</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Cantón</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Parroquia</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Código Sector</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                H. Plan.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                Efec.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                Rech.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                NEC</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                INC</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                T. Lev.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                %
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($plannings as $planning)
                            <tr class="text-xs hover:bg-sky-400 hover:text-white">
                                <td class="px-6 py-1 whitespace-nowrap text-left">{{ $planning->equipment->name }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-left">{{ $planning->provincia }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-left">{{ $planning->canton }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-left">{{ $planning->parroquia }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-left">{{ $planning->codigo_manzana }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    <div class="w-8 h-8 bg-blue-500 mx-auto rounded-full flex justify-center items-center">
                                        <span class=" p-2 rounded-full text-white font-medium">
                                            {{ $planning->hogares_planificados }}</td>
                                        </span>
                                    </div>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    <div class="w-8 h-8 bg-green-500 mx-auto rounded-full flex justify-center items-center">
                                        <span class=" p-2 rounded-full text-white font-medium">
                                            {{ $planning->workers->sum('efectivas') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    {{ $planning->workers->sum('rechazo') }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    {{ $planning->workers->sum('nadie_en_casa') }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    {{ $planning->workers->sum('informante_no_calificado') }}</td>
                                <td class="px-6 py-1 whitespace-nowrap text-center">
                                    <div class="w-8 h-8 bg-sky-500 mx-auto rounded-full flex justify-center items-center">
                                        <span class=" p-2 rounded-full text-white font-medium">
                                            {{ $planning->workers->sum('efectivas') + $planning->workers->sum('rechazo') + $planning->workers->sum('nadie_en_casa') + $planning->workers->sum('informante_no_calificado') }}
                                        </span>
                                    </div>
                                </td>
                                @php
                                    $hogaresProyectados = $planning->hogares_planificados;
                                    $hogaresConseguidos = $planning->workers->sum('efectivas') + $planning->workers->sum('rechazo') + $planning->workers->sum('nadie_en_casa') + $planning->workers->sum('informante_no_calificado');
                                    
                                    $hogaresFaltantes = $hogaresConseguidos * 100;
                                    $porcentajeFaltante = $hogaresFaltantes / $hogaresProyectados;  
                                @endphp
                                <td class="px-1 py-1 whitespace-nowrap text-center">
                                    <div
                                        class="overflow-hidden h-6 text-xs flex rounded-md bg-gray-500 border border-neutral-700">
                                        <div style="width: {{ $porcentajeFaltante . '%' }}"
                                            class="rounded-r-md shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                                            @php
                                            if ($porcentajeFaltante < 100) {
                                                echo 'bg-red-500';
                                            } elseif ($porcentajeFaltante == 100) {
                                                echo 'bg-blue-500';
                                            } else {
                                                echo 'bg-green-500 animate-pulse';
                                            } 
                                            @endphp
                                                transition-all duration-700">
                                            <span class="text-xs p-1 text-center">
                                                {{ number_format($porcentajeFaltante, 2) . '%' . ' ' }} Completado
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-10">
            {{ $plannings->links() }}
        </div>
    </div>

</div>
