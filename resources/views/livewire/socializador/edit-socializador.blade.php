<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-gray-700">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <h1 class="text-lg text-center font-semibold mb-4">Editar informacion de novedad</h1>
    <div class="bg-white p-4 rounded-md text-sm flex justify-between flex-wrap">
        <div>
            <span class="font-semibold">Nombre: </span> {{ auth()->user()->name }}
        </div>
        <div class="capitalize">
            <span class="font-semibold">Rol: </span> {{ auth()->user()->role }}
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 my-6">
        {{--fase --}}
        <div>
            <x-label value="Fase" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="fase">
                <option value="" disabled selected>Seleccione una fase</option>
                <option value="1">Fase 1</option>
                <option value="2">Fase 2</option>
                <option value="3">Fase 3</option>
                <option value="4">Fase 4</option>
                <option value="5">Fase 5</option>
                <option value="6">Fase 6</option>
            </select>
            <x-input-error for="fase" />
        </div>
        <div class="">
            <x-label value="Provincia" />
            <x-input type="text" wire:model="provincia" class="w-full" placeholder="Provincia" />
            <x-input-error for="provincia" />
        </div>
        <div class="">
            <x-label value="Canton" />
            <x-input type="text" wire:model="canton" class="w-full" placeholder="Canton" />
            <x-input-error for="canton" />
        </div>
        <div class="">
            <x-label value="Parroquia" />
            <x-input type="text" wire:model="parroquia" class="w-full" placeholder="Parroquia" />
            <x-input-error for="parroquia" />
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 my-6">
        {{-- Codigo de manzana --}}
        <div class="">
            <x-label value="Codigo de sector/manzana" />
            <x-input type="text" wire:model="codigo_manzana" class="w-full" placeholder="Codigo de manzana" />
            <x-input-error for="codigo_manzana" />
        </div>
        <div class="">
            <x-label value="Hogares Planificados" />
            <x-input type="text" wire:model="hogares_p" class="w-full" placeholder="Hogares planificados" />
            <x-input-error for="hogares_p" />
        </div>
        <div class="">
            <x-label value="Hogares Identificados" />
            <x-input type="text" wire:model="hogares_i" class="w-full" placeholder="Hogares identificados" />
            <x-input-error for="hogares_i" />
        </div>
        <div class="">
            <x-label value="Dipticos" />
            <x-input type="text" wire:model="dipticos" class="w-full" placeholder="Dipticos" />
            <x-input-error for="dipticos" />
        </div>
        <div>
            <x-label value="Estado" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="status">
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="cerrrado">Cerrado</option>
                <option value="abierto">Abierto</option>
            </select>
            <x-input-error for="status" />
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
        <div class="h-10 my-auto ml-0 md:ml-auto flex justify-center items-center">
            <x-action-message class="mr-3" on="saved">
                Actualizado.
            </x-action-message>
            <x-button wire:loading.attr="disabled" wire:target="updateSocializador" wire:click="updateSocializador" class="">
                Actualizar
            </x-button>
        </div>
    </div>




</div>
