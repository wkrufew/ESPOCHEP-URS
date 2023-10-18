<div class="max-w-5xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="p-6 rounded-md bg-white">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight uppercase">Cambiar Estado de Certificados</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 pt-6">
            <div class="mb-4 w-56">
                <x-label value="Inicio" />
                <x-input type="number" wire:model="inicio" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de inicio" />
                <x-input-error for="inicio" />
            </div>
            <div class="mb-4 w-56">
                <x-label value="Fin" />
                <x-input type="number" wire:model="fin" min="7" max="7" class="w-full"
                    placeholder="Ingrese el valor de finalización" />
                <x-input-error for="fin" />
            </div>
            <div class="mb-4">
                <x-label value="Nuevo Estado" />
                <select wire:model.live="nuevoEstado" class="w-full rounded-md border border-gray-300">
                    <option value="Disponible">Disponible</option>
                    <option value="Danado">Dañado</option>
                    <option value="Anulado">Anulado</option>
                    <option value="Extraviado">Extraviado</option>
                </select>
                <x-input-error for="nuevoEstado" />
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <x-button wire:loading.attr="disabled" wire:target="cambiarEstado" wire:click="cambiarEstado">
                Cambiar Estado
            </x-button>
        </div>

        <div class="mt-6">
            @if (session()->has('message'))
                @if (session('message') === 'Estado de los certificados actualizado exitosamente.')
                    <p class="mt-4 py-2 px-4 rounded-md text-white bg-green-500">{{ session('message') }}</p>
                @else
                    <p class="mt-4 py-2 px-4 rounded-md text-white bg-red-500">{{ session('message') }}</p>
                @endif
            @endif
        </div>
    </div>
</div>
