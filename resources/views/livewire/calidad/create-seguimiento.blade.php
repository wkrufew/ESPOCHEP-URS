<div class="max-w-6xl mx-auto p-6">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
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
        <div class="flex flex-col md:flex-row justify-center md:space-x-6 mt-6">
            <div>
                <x-label value="Tipo" />
                <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model.live="tipo">
                    <option value="">Seleccione un tipo</option>
                    <option value="Seguimiento">Seguimiento</option>
                    <option value="Supervision">Supervision</option>
                </select>
                <x-input-error for="tipo" />
            </div>
            <div class="mb-4 relative mx-auto  md:w-56 mt-4 md:mt-0">
                <x-label value="Certificado" />
                <div class="flex justify-center">
                    <input class="rounded-md  border border-gray-300 w-full mx-auto md:w-56" wire:model.live.debounce.500ms="search" type="text"
                        placeholder="Buscar certificado">
                    @if ($certificados && $certificados->count())
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
                        <p><span
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

        {{-- DATOS ENCUESTADOR --}}
        <div class="mt-6 bg-white p-6 rounded-md">
            <h2 class="text-center font-semibold uppercase">Datos de la Encuesta</h2>
            @if ($selectedCertificado && $datos_encuestador)
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
                <div class="flex justify-evenly text-sm">
                    <div>
                        @if ($datos_encuestador->efectivas)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->efectivas ? 'Efectiva' : '' }}
                        @elseIf($datos_encuestador->temporal)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->temporal ? 'Temporal' : '' }}
                        @elseIf($datos_encuestador->nadie_en_casa)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->nadie_en_casa ? 'Nadie en Casa' : '' }}
                        @elseIf($datos_encuestador->construccion)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->construccion ? 'Construccion' : '' }}
                        @elseIf($datos_encuestador->destruida)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->destruida ? 'Destruida' : '' }}
                        @elseIf($datos_encuestador->desocupada)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->desocupada ? 'Desocupada' : '' }}
                        @elseIf($datos_encuestador->rechazo)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->rechazo ? 'Rechazo' : '' }}
                        @elseIf($datos_encuestador->informante_no_calificado)
                            <span class="font-semibold">Encuesta: </span>
                            {{ $datos_encuestador->informante_no_calificado ? 'Informante No Calificado' : '' }}
                        @endif
                    </div>
                    <div>
                        <span class="font-semibold">Certificado: </span>
                        {{ $datos_encuestador->certificado->code ? $datos_encuestador->certificado->code : '' }}
                    </div>
                    <div class="mb-4">
                        <span class="font-semibold">Sticker: </span>
                        {{ $datos_encuestador->sticker->code ? $datos_encuestador->sticker->code : '' }}
                    </div>
                </div>
                {{-- PLANIFICACION --}}
                <hr>
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
                        <span class="font-semibold">Tipo Sector: </span>
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
        <div class="p-3 mt-6 bg-white rounded-md shadow-md">
            <h2 class="text-sm text-center font-medium uppercase">Calificacion de Encuesta
                @if ($datos_encuestador)
                    a {{ $datos_encuestador->user->name }}
                @endif
            </h2>
            <div>
                @if ($tipo == 'Seguimiento')
                    <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mt-4">
                        <div class="">
                            <h3 class="text-xs font-medium text-center">Registro Nombres?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="id1"
                                        class="cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_nombres" type="radio" name="registro_nombres"
                                            value="Si" id="id1" class="mr-2 appearance-none">
                                    </label>
                                    <label for="id4"
                                        class="cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_nombres" class=" appearance-none" type="radio"
                                        value="No" name="registro_nombres" id="id2">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_nombres" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Sexo?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_sexosi"
                                        class="cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_sexo" class="mr-2 appearance-none" type="radio"
                                        value="Si"name="registro_sexo" id="registro_sexosi">
                                    </label>
                                    <label for="registro_sexono"
                                        class="cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_sexo" class=" appearance-none" type="radio"
                                        value="No"name="registro_sexo" id="registro_sexono">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_sexo" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Nacimiento?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_nacimientosi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_nacimiento" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="registro_nacimiento" id="registro_nacimientosi">
                                    </label>
                                    <label for="registro_nacimientono"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_nacimiento" class=" appearance-none"
                                        value="No" type="radio" name="registro_nacimiento" id="registro_nacimientono">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_nacimiento" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Cedula?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_cedulasi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_cedula" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="registro_cedula" id="registro_cedulasi">
                                    </label>
                                    <label for="registro_cedulano"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_cedula" class=" appearance-none" type="radio"
                                        value="No" name="registro_cedula" id="registro_cedulano">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_cedula" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Parentesco?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_aparentesco_hogarsi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_aparentesco_hogar" class="mr-2 appearance-none"
                                           value="Si" type="radio" name="registro_aparentesco_hogar"
                                            id="registro_aparentesco_hogarsi">
                                    </label>
                                    <label for="registro_aparentesco_hogarno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_aparentesco_hogar" class=" appearance-none"
                                        value="No" type="radio" name="registro_aparentesco_hogar"
                                            id="registro_aparentesco_hogarno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_aparentesco_hogar" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Nucleos?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_nucleossi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_nucleos" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="registro_nucleos" id="registro_nucleossi">
                                    </label>
                                    <label for="registro_nucleosno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_nucleos" class=" appearance-none" type="radio"
                                        value="No" name="registro_nucleos" id="registro_nucleosno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_nucleos" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Parentesco con el nucleo familiar?
                            </h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_aparentesco_nucleosi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_aparentesco_nucleo" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="registro_aparentesco_nucleo"
                                            id="registro_aparentesco_nucleosi">
                                    </label>
                                    <label for="registro_aparentesco_nucleono"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_aparentesco_nucleo" class=" appearance-none"
                                        value="No" type="radio" name="registro_aparentesco_nucleo"
                                            id="registro_aparentesco_nucleono">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_aparentesco_nucleo" />
                        </div>
                    </div>
                @elseIf($tipo == 'Supervision')
                    <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mt-4">
                        <div class="">
                            <h3 class="text-xs font-medium text-center">Registro Ubicacion?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="ubicacionsi" 
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="ubicacion" type="radio" name="ubicacion"
                                        value="Si"    value="Si" id="ubicacionsi" class="mr-2 appearance-none">
                                    </label>
                                    <label for="ubicacionno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="ubicacion" class=" appearance-none" type="radio"
                                        value="No"   name="ubicacion" id="ubicacionno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="ubicacion" />
                        </div>
                        <div class="">
                            <h3 class="text-xs font-medium text-center">Presentacion?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="presentacionsi" 
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="presentacion" type="radio" name="presentacion"
                                        value="Si"   value="activo" id="presentacionsi" class="mr-2 appearance-none">
                                    </label>
                                    <label for="presentacionno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="presentacion" class="appearance-none" type="radio"
                                        value="No"   name="presentacion" id="presentacionno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="presentacion" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Objetivo?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="objetivosi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="objetivo" class="mr-2 appearance-none" type="radio"
                                        value="Si" name="objetivo" id="objetivosi">
                                    </label>
                                    <label for="objetivono"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="objetivo" class="appearance-none" type="radio"
                                        value="No"   name="objetivo" id="objetivono">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="objetivo" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Tipo de Vivienda?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="tipo_viviendasi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="tipo_vivienda" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="tipo_vivienda" id="tipo_viviendasi">
                                    </label>
                                    <label for="tipo_viviendano"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="tipo_vivienda" class="appearance-none"
                                        value="No" type="radio" name="tipo_vivienda" id="tipo_viviendano">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="tipo_vivienda" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Diligencia las Preguntas?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="diligencia_preguntassi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="diligencia_preguntas" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="diligencia_preguntas" id="diligencia_preguntassi">
                                    </label>
                                    <label for="diligencia_preguntasno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="diligencia_preguntas" class="appearance-none" type="radio"
                                        value="No" name="diligencia_preguntas" id="diligencia_preguntasno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="diligencia_preguntas" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Miembros del hogar?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="miembros_hogarsi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="miembros_hogar" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="miembros_hogar"
                                            id="miembros_hogarsi">
                                    </label>
                                    <label for="miembros_hogarno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="miembros_hogar" class=" appearance-none"
                                        value="No" type="radio" name="miembros_hogar"
                                            id="miembros_hogarno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="miembros_hogar" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Numero de Nucleos?</h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="numero_nucleossi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="numero_nucleos" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="numero_nucleos" id="numero_nucleossi">
                                    </label>
                                    <label for="numero_nucleosno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="numero_nucleos" class=" appearance-none" type="radio"
                                        value="No" name="numero_nucleos" id="numero_nucleosno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="numero_nucleos" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Registro Certificado?
                            </h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="registro_certificadosi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="registro_certificado" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="registro_certificado"
                                            id="registro_certificadosi">
                                    </label>
                                    <label for="registro_certificadono"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="registro_certificado" class=" appearance-none"
                                        value="No" type="radio" name="registro_certificado"
                                            id="registro_certificadono">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="registro_certificado" />
                        </div>
                        <div>
                            <h3 class="text-xs font-medium text-center">Forlumarios Imagenes?
                            </h3>
                            <div class="flex justify-center mt-2">
                                <div class="flex items-center justify-center">
                                    <label for="formulario_imagenessi"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">Si</span>
                                        <input wire:model="formulario_imagenes" class="mr-2 appearance-none"
                                        value="Si" type="radio" name="formulario_imagenes"
                                            id="formulario_imagenessi">
                                    </label>
                                    <label for="formulario_imagenesno"
                                        class="hover:cursor-pointer flex items-center text-xs font-medium">
                                        <span class="mr-1">No</span>
                                        <input wire:model="formulario_imagenes" class=" appearance-none"
                                        value="No"type="radio" name="formulario_imagenes"
                                            id="formulario_imagenesno">
                                    </label>
                                </div>
                            </div>
                            <x-input-error for="formulario_imagenes" />
                        </div>
                    </div>
                @endif
            </div>
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
            <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save" class="">
                Crear Registro
            </x-button>
        </div>
    </div>
</div>
