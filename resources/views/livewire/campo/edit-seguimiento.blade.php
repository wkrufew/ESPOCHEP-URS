<div class="max-w-6xl mx-auto p-6">
    <div wire:loading>
        <x-loading message="Cargando datos..." />
    </div>
    <div>
        {{-- DATOS SUPERVISOR --}}
        <div>
            <div class="bg-white p-4 rounded-md text-sm flex justify-between flex-wrap">
                <div>
                    <span class="font-semibold">Nombre: </span> {{ auth()->user()->name }}
                </div>
                <div class="capitalize">
                    <span class="font-semibold">Rol: </span> {{ auth()->user()->role }}
                </div>
                <div>
                    <span class="font-semibold">Equipo: </span>
                    @if (!empty(auth()->user()->equipment->name))
                        {{ auth()->user()->equipment->name }}
                    @else
                        Sin equipo
                    @endif
                </div>
            </div>
        </div>
        {{-- TIPO Y FECHA --}}
        <div class="flex justify-center space-x-6 mt-6">
            <div>
                <x-label value="Estado" />
                <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model.live="tipo">
                    <option value="">Seleccione un estado</option>
                    <option value="Seguimiento">Seguimiento</option>
                    <option value="Supervision">Supervision</option>
                </select>
                <x-input-error for="tipo" />
            </div>
            {{-- AQUI BUSCADOR PREDICTIVO --}}
            <div class="mb-4 relative mx-auto w-56">
                <x-label value="Certificado" />
                <div>
                    <input class="rounded-md border border-gray-300 w-56" wire:model.live.debounce.500ms="search"
                        type="text" placeholder="Buscar certificado">
                    @if ($certificados)
                        <div class="absolute w-56 mt-1 hidden z-50 bg-white p-1 rounded-md border border-gray-100 shadow-lg"
                            :class="{ 'hidden': !$wire.open }" x-on:click.away="$wire.open = false">
                            <ul>
                                @foreach ($certificados as $certificado)
                                    <li x-on:click.away="$wire.open = false"
                                        class="hover:bg-green-200 px-1 py-0.5 rounded-md cursor-pointer"
                                        wire:click="seleccionarCertificado({{ $certificado->id }})">
                                        {{ $certificado->code }} - {{ $certificado->equipment->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                    @endif
                </div>
                <div class="w-full mt-2">
                    <div class="flex justify-center">
                        <p>{{-- Equipo seleccionado: --}} <span
                                class="{{ $selectedCertificado ? 'bg-green-500' : 'bg-gray-500' }} text-white px-2 py-1 rounded-full text-sm">
                                {{ $selectedCertificado ? $selectedCertificado->code : 'Elegir un Certificado' }}</span>
                        </p>
                    </div>
                    @error('selectedCertificado')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- <div class="">
                <x-label value="Certificados" />
                <select class="w-full border border-gray-200 rounded-md shadow-sm" :disabled="!$tipoSeleccionado" wire:model.live="certificado_id">
                    <option value="">Seleccione una certificado</option>
                    @foreach ($certificados as $certificado)
                        <option value="{{ $certificado->id }}">{{ $certificado->code }}</option>
                    @endforeach
                </select>
                <x-input-error for="certificado_id" />
            </div> --}}
        </div>

        {{-- DATOS ENCUESTADOR --}}
        <div class="mt-6 bg-white p-6 rounded-md">
            <h2 class="text-center font-semibold uppercase">Datos de la Encuesta</h2>
            @if ($certificado_id && $datos_encuestador)
                <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">Fecha Encuesta:
                        </span>{{ \Carbon\Carbon::parse($datos_encuestador->fecha_encuesta)->format('d/m/Y') }}
                    </div>
                    <div>
                        <span class="font-semibold">Encuestador: </span> {{ $datos_encuestador->user->name }}
                    </div>
                    <div>
                        <span class="font-semibold">Cedula: </span> {{ $datos_encuestador->user->cedula }}
                    </div>
                    <div>
                        <span class="font-semibold">Telefono: </span> {{ $datos_encuestador->user->phone }}
                    </div>
                </div>
                <div class="mt-4 text-sm">
                    <span class="font-semibold">Observacion: </span> {{ $datos_encuestador->observacion }}
                </div>
                <div class="flex justify-evenly mb-4">
                    <div>
                        <span class="font-semibold">Certificado: </span> {{ $datos_encuestador->certificado->code }}
                    </div>
                    <div>
                        <span class="font-semibold">Sticker: </span> {{ $datos_encuestador->sticker->code }}
                    </div>
                </div>
                <hr>
                {{-- PLANIFICACION --}}
                <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">Planificacion: </span> {{ $datos_encuestador->planning->code }}
                    </div>
                    <div>
                        <span class="font-semibold">Fase: </span> {{ $datos_encuestador->planning->phase->name }}
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <span class="font-semibold">Fecha Inicio: </span>
                        {{ \Carbon\Carbon::parse($datos_encuestador->planning->fecha_inicio)->format('d/m/Y') }} -
                        {{ \Carbon\Carbon::parse($datos_encuestador->planning->fecha_fin)->format('d/m/Y') }}
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">Provincia: </span> {{ $datos_encuestador->planning->provincia }}
                    </div>
                    <div>
                        <span class="font-semibold">Canton: </span> {{ $datos_encuestador->planning->canton }}
                    </div>
                    <div>
                        <span class="font-semibold">Parroquia: </span> {{ $datos_encuestador->planning->parroquia }}
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4 text-sm">
                    <div>
                        <span class="font-semibold">DPA: </span> {{ $datos_encuestador->planning->dpa }}
                    </div>
                    <div>
                        <span class="font-semibold">Area Censal: </span> {{ $datos_encuestador->planning->areacensal }}
                    </div>
                    <div>
                        <span class="font-semibold">Codigo Manzana: </span>
                        {{ $datos_encuestador->planning->codigo_manzana }}
                    </div>
                    <div>
                        <span class="font-semibold">Tipo Sector: </span> {{-- {{$datos_encuestador->planning->tipo_sector}} --}}
                        @switch($datos_encuestador->planning->tipo_sector)
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
                    Elegir un Certificado
                </div>
            @endif
        </div>
        {{-- OBSERVACION --}}
        <div class="mt-6">
            <div class="">
                <x-label>
                    Observacion
                </x-label>
                <textarea class="w-full resize mt-1 rounded-md border border-gray-300" wire:model="observacion" name=""
                    id="" rows="2"></textarea>
                <x-input-error for="observacion" />
            </div>
        </div>
        {{-- BOTON DE CREAR --}}
        <div class="mt-6 flex justify-center">
            <x-action-message class="mr-3" on="saved">
                Actualizado
            </x-action-message>
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
                Actualizar {{ $tipo }}
            </x-button>
        </div>
    </div>
</div>
