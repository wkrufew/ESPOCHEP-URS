<div class="max-w-6xl mx-auto p-4 bg-white rounded-md my-10">
    <div wire:loading>
        <x-loading message="Cargando datos..." />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <x-label>
                Nombre
            </x-label>

            <x-input wire:model="name" type="text" class="w-full mt-1" />

            <x-input-error for="name" />
        </div>

        <div>
            <x-label>
                Correo
            </x-label>

            <x-input wire:model="email" type="text" class="w-full mt-1" />

            <x-input-error for="email" />
        </div>
        <div>
            <x-label>
                Contraseña Nueva (Opciona)
            </x-label>

            <x-input wire:model="newPassword" type="text" class="w-full mt-1" />

            <x-input-error for="newPassword" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div>
            <x-label>
                Telefono
            </x-label>

            <x-input wire:model="phone" type="text" class="w-full mt-1" />

            <x-input-error for="phone" />
        </div>

        <div>
            <x-label>
                Cedula
            </x-label>

            <x-input wire:model="cedula" type="text" class="w-full mt-1" />

            <x-input-error for="cedula" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
        <div>
            <x-label value="Tipo de Sector" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model="role">
                <option value="administrador">Administrador</option>
                <option value="gerencia">Gerencia</option>
                <option value="provincial">Coordinador Provincial</option>
                <option value="calidad">Supervisor de Calidad</option>
                <option value="campo">Supervisor de Campo</option>
                <option value="encuestador">Encuestador</option>
                <option value="socializador">Socializador</option>
                <option value="user">Usuario Normal</option>
            </select>
            <x-input-error for="role" />
        </div>
        <div>
            <x-label value="Equipos" />
            <select class="w-full border border-gray-200 rounded-md shadow-sm" wire:model.live="equipment_id">
                <option value="">Seleccione una fase</option>

                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}" @if ($equipo->id == $user->equipment_id) selected @endif>
                        {{ $equipo->name }}</option>
                @endforeach
            </select>
            <x-input-error for="equipment_id" />
        </div>
        <div class="">
            <p class="text-sm text-center font-semibold mb-2">Estado del Usuario </p>
            <div class="flex justify-center">
                <label class="mr-6">
                    <input wire:model="status" type="radio" name="status" value="activo">
                    Activo
                </label>
                <label>
                    <input wire:model="status" type="radio" name="status" value="inactivo">
                    Inactivo
                </label>
            </div>
        </div>
    </div>
    @error('currentPassword')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    <div class="flex justify-center items-center mt-6">
        <x-action-message class="mr-3" on="saved">
            Actualizado.
        </x-action-message>
        <x-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
            Actualizar
        </x-button>
    </div>
</div>
