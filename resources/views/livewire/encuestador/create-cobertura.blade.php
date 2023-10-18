<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-gray-700">

    <h1 class="text-lg text-center font-semibold mb-4">Complete esta información para crear su cobertura diaria de
        trabajo</h1>
    <div class="bg-white p-4 rounded-md text-sm flex justify-between flex-wrap">
        <div class="capitalize">
            <span class="font-semibold uppercase">Rol: </span> {{ auth()->user()->role }}
        </div>
        <div>
            <span class="font-semibold">Equipo: </span> 
            @if (!empty(auth()->user()->equipment->name))
                {{auth()->user()->equipment->name}}
            @else
                Sin equipo
            @endif
        </div>
        <div>
            <span class="font-semibold">Nombre: </span> {{ auth()->user()->name }}
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-6">
        {{-- Asignaciones --}}
        <div>
            <div>
                <x-label value="Planificacion" />
                <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model.live="planning_id">
                    <option value="" selected disabled>Seleccione una Planificacion</option>
                    @foreach ($planificaciones as $planificacion)
                        <option value="{{ $planificacion->id }}">{{ $planificacion->code }}  - {{ $planificacion->codigo_manzana }}</option>
                    @endforeach
                </select>
                <x-input-error for="planning_id" />
            </div>
            {{-- Fecha de encuesta --}}
            <div class="my-4">
                <x-label value="Fecha de Encuesta" />
                <x-input type="date" :disabled="!$asignacionSeleccionada" wire:model.live="fecha_encuesta" class="w-full"
                    placeholder="" />

                <x-input-error for="fecha_encuesta" />
                <div class="text-sm text-red-500 mt-1">
                    {{ $mensaje ? $mensaje : '' }}
                </div>
            </div>
            {{-- Dia de la fase --}}
            <div class="mb-4 flex">
                <span>Dia: </span>
                <div class="ml-3 border border-gray-400 bg-gray-200 rounded-md w-full py-1 text-center px-2">
                    {{ $dia ? $dia : 'Elegir fecha' }}
                </div>
            </div>
            <div>
                <x-label value="Tipo de encuesta" />
                <select class="w-full border border-gray-200 rounded-md shadow-sm" @if(!$fechaSeleccionada) disabled @endif wire:model.live="selectedTipo">
                    <option value="" selected disabled>Seleccione un tipo</option>
                    <option value="efectivas">Efectiva</option>
                    <option value="rechazo">Rechazo</option>
                    <option value="nadie_en_casa">Nadie en casa</option>
                    <option value="informante_no_calificado">Informante no calificado</option>
                    <option value="temporal">Temporal</option>
                    <option value="desocupada">Desocupada</option >
                    <option value="construccion">Construccion</option>
                    <option value="destruida">Destruida</option>
                </select>
                <x-input-error for="selectedTipo" />
            </div>
            {{-- Certificados --}}
            @if ($selectedTipo == 'efectivas')
                <div class="mt-4 relative mx-auto full">
                    <x-label value="Certificado" />
                    <div>
                        <input class="rounded-md border border-gray-300 w-full" wire:model.live.debounce.500ms="searchCertificados"
                            type="text" placeholder="Buscar certificados">
                        @if ($certificados)
                            <div class="absolute w-full mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                                :class="{ 'hidden': !$wire.open1 }" x-on:click.away="$wire.open1 = false">
                                <ul>
                                    @foreach ($certificados as $certificado)
                                        <li x-on:click.away="$wire.open1 = false"
                                            class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                            wire:click="seleccionarCertificado({{ $certificado->id }})">
                                            {{ $certificado->code }} - {{ $certificado->equipment->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                        @endif
                        <div class="mt-2">
                            <div class="flex justify-center">
                                <p class="text-sm">Certificado: <span
                                        class="{{ $selectedCertificado ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                                        {{ $selectedCertificado ? $selectedCertificado->code : 'Elegir un Certificado' }}</span>
                                </p>
                            </div>
                            @error('selectedCertificado')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif

            @if ($selectedTipo == 'efectivas' || $selectedTipo == 'rechazo' || $selectedTipo == 'nadie_en_casa' || $selectedTipo == 'informante_no_calificado')
                <div class="mt-4 relative mx-auto full">
                    <x-label value="Sticker" />
                    <div>
                        <input class="rounded-md border border-gray-300 w-full" wire:model.live.debounce.500ms="searchStickers" type="text"
                            placeholder="Buscar Stickers...">
                        @if ($stickers)
                            <div class="absolute w-full mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                                :class="{ 'hidden': !$wire.open2 }" x-on:click.away="$wire.open2 = false">
                                <ul>
                                    @foreach ($stickers as $sticker)
                                        <li x-on:click.away="$wire.open2 = false"
                                            class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                            wire:click="seleccionarSticker({{ $sticker->id }})">
                                            {{ $sticker->code }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                        @endif
                        <div class="mt-2">
                            <div class="flex justify-center">
                                <p class="text-sm">Sticker: <span
                                        class="{{ $selectedSticker ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                                        {{ $selectedSticker ? $selectedSticker->code : 'Elegir un Sticker' }}</span>
                                </p>
                            </div>
                            @error('selectedSticker')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif
                <div wire:loading>
                    <x-loading message="Cargando datos..."/>
                </div>

        </div>
        <div class="bg-white p-4 rounded-md col-span-1 md:col-span-2">
            <h2 class="text-center font-semibold uppercase">Datos de la Planificacion</h2>
            @if ($planning_id && $asignacion_datos)
                <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">Planificacion: </span> {{ $asignacion_datos->code }}
                    </div>
                    <div>
                        <span class="font-semibold">Fase: </span> {{ $asignacion_datos->phase->name }}
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <span class="font-semibold">Fecha Inicio: </span>
                        {{ \Carbon\Carbon::parse($asignacion_datos->fecha_inicio)->format('d/m/Y') }} -
                        {{ \Carbon\Carbon::parse($asignacion_datos->fecha_fin)->format('d/m/Y') }}
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">Provincia: </span> {{ $asignacion_datos->provincia }}
                    </div>
                    <div>
                        <span class="font-semibold">Canton: </span> {{ $asignacion_datos->canton }}
                    </div>
                    <div>
                        <span class="font-semibold">Parroquia: </span> {{ $asignacion_datos->parroquia }}
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">DPA: </span> {{ $asignacion_datos->dpa }}
                    </div>
                    <div>
                        <span class="font-semibold">Area Censal: </span> {{ $asignacion_datos->areacensal }}
                    </div>
                    <div>
                        <span class="font-semibold">Codigo Manzana: </span> {{ $asignacion_datos->codigo_manzana }}
                    </div>
                    <div>
                        <span class="font-semibold">Tipo Sector: </span>
                        @switch($asignacion_datos->tipo_sector)
                            @case(1)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Amanzando
                                </span>
                            @break

                            @case(2)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Disperso
                                </span>
                            @break

                            @default
                        @endswitch
                    </div>
                </div>
            @else
                <div class="flex justify-center items-center h-full">
                    Elegir una planificacion
                </div>
            @endif
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
        <div class="col-span-1 md:col-span-3">
            <div class="">
                <x-label>
                    Observacion
                </x-label>
                <textarea class="w-full resize mt-1 rounded-md border border-gray-300" wire:model="observacion" name=""
                    id="" rows="2"></textarea>
                <x-input-error for="observacion" />
            </div>
        </div>
        <div class="h-10 my-auto ml-0 md:ml-auto flex justify-center">
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
                Crear Cobertura
            </x-button>
        </div>
    </div>
</div>
