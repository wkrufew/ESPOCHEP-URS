<div class="max-w-5xl mx-auto p-6 lg:p-8 py-12">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="p-6 rounded-md bg-white">
        <h2 class="text-center font-semibold text-xl text-gray-800 leading-tight uppercase">Cambiar Estado de
            Planificaciones</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 pt-6">
            <div class="mb-4 w-56">
                <x-label value="Inicio" />
                <x-input type="text" wire:model="inicio" min="5" max="7" class="w-full"
                    placeholder="Ingrese el codigó de inicio" />
                <x-input-error for="inicio" />
            </div>
            <div class="mb-4 w-56">
                <x-label value="Fin" />
                <x-input type="text" wire:model="fin" min="5" max="7" class="w-full"
                    placeholder="Ingrese el codigó de finalización" />
                <x-input-error for="fin" />
            </div>
            <div class="mb-4">
                <x-label value="Nuevo Estado" />
                <select wire:model.live="nuevoEstado" class="w-full rounded-md border border-gray-300">
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                    <option value="2">Cerrado</option>
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
                <div class="w-auto mx-auto p-4 mt-6">
                    @if (session('messageType') === 'success')
                        <div class="alert alert-success bg-green-500 text-white px-3 py-2 rounded-md text-center">
                            {{ session('message') }}
                        </div>
                    @else
                        <div class="alert alert-danger bg-red-500 text-white px-3 py-2 rounded-md text-center">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
