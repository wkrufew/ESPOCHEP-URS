<div class="max-w-6xl mx-auto rounded-md bg-white p-6 mt-6">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="flex justify-center space-x-6">
        <input class="rounded-md border border-gray-300 text-sm" wire:model="searchQuery" type="text"
            placeholder="Cédula o Nombre">
        <button class="text-sm bg-gray-800 text-white rounded-md px-3" wire:click="searchUser">Buscar</button>
    </div>

    @if ($user)
        <div class="py-6">
            <hr>
        </div>
        <div class="max-w-lg mx-auto">
            <p class="text-sm"><span class="font-semibold">Nombre: </span> {{ $user->name }}</p>
            <p><span class="font-semibold text-sm">Equipo: </span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-sky-800">
                    {{ optional($user->equipment)->name ? optional($user->equipment)->name : 'Sin asignar' }}
                </span>
            </p>
            <p>
                <span class="font-semibold text-sm">Estado: </span>
                @switch($user->status)
                    @case('activo')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activo
                        </span>
                    @break

                    @case('inactivo')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Inactivo
                        </span>
                    @break

                    @default
                @endswitch
            </p>
            <p>
                <span class="font-semibold text-sm">Cargo: </span>
                @switch($user->role)
                    @case('admin')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Administrador
                        </span>
                    @break

                    @case('gerente')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Gerente
                        </span>
                    @break

                    @case('calidad')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Supervisor de Calidad
                        </span>
                    @break

                    @case('campo')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Supervisor de Campo
                        </span>
                    @break

                    @case('encuestador')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-skbg-sky-800">
                            Encuestador
                        </span>
                    @break

                    @case('socializador')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Socializador
                        </span>
                    @break
                    @case('provincial')
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-rose-100 text-rose-800">
                            Coordinador Provincial
                        </span>
                    @break

                    @default
                @endswitch
            </p>
        </div>
    @endif

    <div class="w-full mx-auto mt-6">
        @if ($errorMessage)
        <div class="w-56 mx-auto">
            <p class="bg-red-500 text-white rounded-md px-3 py-2 text-sm">{{ $errorMessage }}</p>
        </div>
        @endif
    </div>
</div>
