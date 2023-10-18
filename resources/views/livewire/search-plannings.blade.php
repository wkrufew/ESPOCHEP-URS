<div>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="max-w-6xl mx-auto bg-white rounded-md p-4 mt-4">
        <h2 class="text-center py-4 font-semibold">CONSULTA DE PLANIFICACIONES ASIGNADAS</h2>
        <div class="max-w-lg mx-auto p-4 mt-4">
            <div class="flex justify-evenly">
                <div>
                    <x-label>
                        Fase
                    </x-label>
                    <select class="border border-gray-300 rounded-md" name="" id="" wire:model="phases">
                        <option value="">Seleccione una fase</option>
                        @foreach ($fases as $fase)
                            <option value="{{ $fase->id }}">{{ $fase->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="phases" />
                </div>
                <div>
                    <x-label>
                        Numero de Equipo
                    </x-label>
                    <x-input wire:model="equipmentNumber" type="text" placeholder="Número de equipo Ejm. C4G01"
                        class="w-full" />
                    <x-input-error for="equipmentNumber" />
                </div>
            </div>
        </div>
        <div class="p-4 flex justify-center">
            <button class="px-4 py-2 rounded-full bg-gray-800 text-white" wire:click="search">Consultar</button>
        </div>

        <div class="">
            @if ($errorMessage)
                <div class="w-96 mx-auto mt-4">
                    <p class="bg-red-500 text-white rounded-md px-3 py-2 text-sm text-center">{{ $errorMessage }}
                    </p>
                </div>
            @else
                <div class="flex justify-center w-full mx-auto mt-4">
                    <div wire:loading>
                        Buscando...
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if ($visible)
        <div class="max-w-6xl mx-auto bg-white rounded-md p-4 mt-4">
            @if (!empty($planifications))
                <h3 class="text-center uppercase font-semibold">Resultados</h3>
                <div class="text-sm grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- <hr> --}}
                    @foreach ($planifications as $planification)
                        <div class="border border-gray-400 shadow-md p-2 rounded-md">
                            <div class="flex justify-between">
                                <div>
                                    <p><b>Codigo: </b> {{ $planification->code }}</p>
                                </div>
                                <div>
                                    <p><b>Fase: </b> {{ $planification->phase->name }}</p>
                                </div>
                                <div>
                                    <p><b>Equipo: </b> {{ $planification->equipment->name }}</p>
                                </div>
                            </div>
                            <p><b>Provincia: </b> {{ $planification->provincia }}</p>
                            <p><b>Canton: </b> {{ $planification->canton }}</p>
                            <p><b>Parroquia: </b> {{ $planification->parroquia }}</p>
                            <p><b>Codigo de Sector/Manzana: </b> {{ $planification->codigo_manzana }}</p>
                            <p><b>Hogares Planificados: </b> {{ $planification->hogares_planificados }}</p>
                            <p><b>Fecha Intervencion: </b>
                                {{ \Carbon\Carbon::parse($planification->fecha_inicio)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($planification->fecha_fin)->format('d/m/Y') }} </p>
                            <p><b>Dias de intervencion: </b> {{ $planification->dias }}</p>
                            <p><b>Tipo Sector: </b>
                                @switch($planification->tipo_sector)
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
                            </p>
                            <p><b>Estado: </b>
                                @switch($planification->status)
                                    @case(1)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-sky-800">
                                            Abierto
                                        </span>
                                    @break

                                    @case(2)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Cerrado
                                        </span>
                                    @break

                                    @default
                                @endswitch
                        </div>
                    @endforeach
                </div>
            @else
                no se encontraron resultados
            @endif
        </div>
    @else
    @endif
</div>
