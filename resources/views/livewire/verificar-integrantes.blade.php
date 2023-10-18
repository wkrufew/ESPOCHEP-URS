<div class="max-w-6xl mx-auto rounded-md bg-white p-6 mt-6">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="flex justify-center space-x-6">
        <input class="rounded-md border border-gray-300 text-sm" wire:model="teamName" type="text"
            placeholder="C4G01">
        <button class="text-sm bg-gray-800 text-white rounded-md px-3" wire:click="searchMembers">Buscar</button>
    </div>

    @if (!empty($users))
        <div class="py-6">
            <hr>
        </div>
        <div class="max-w-2xl mx-auto">
            <div>
                <h2 class="pb-4 font-semibold uppercase text-center">Usuarios del Equipo</h2>
                <ul class="space-y-3">
                    @foreach ($users as $user)
                        <li class="">
                            @switch($user->status)
                                @case('activo')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                @break

                                @case('inactivo')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Inactivo
                                    </span>
                                @break

                                @default
                            @endswitch
                            - <span class="text-sm"> {{ $user->name }} </span> 
                            - <span class="text-sm"> {{ $user->phone ? $user->phone : 'Sin telefono' }} </span> -
                            @switch($user->role)
                                @case('admin')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Administrador
                                    </span>
                                @break

                                @case('gerente')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Gerente
                                    </span>
                                @break

                                @case('calidad')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Supervisor de Calidad
                                    </span>
                                @break

                                @case('campo')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
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

                                @default
                            @endswitch
                        </li>
                    @endforeach
                </ul>
            </div>
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
