<div class="max-w-7xl mx-auto p-6 bg-white rounded-md mt-4">
    <div wire:loading>
        <x-loading message="Cargando datos..." />
    </div>
    <div>
        <h2 class="text-lg font-semibold text-center mt-3 mb-5">BUSQUEDA DE EQUIPOS PARA VERIFICAR CARGA POR DIA</h2>
        <div class="flex justify-center">
            <div>
                <input class="rounded-md border border-gray-300 text-sm" wire:model="equipmentNumber"
                    type="text" placeholder="Número de equipo C4G01">
                <div>
                    <x-input-error for="equipmentNumber" />
                </div>
            </div>
            <div>
                <input class="rounded-md border border-gray-300 text-sm ml-3" wire:model="fecha" type="date"
                    placeholder="Fecha de busqueda">
                <div>
                    <x-input-error for="fecha" />
                </div>
            </div>
            <button class="bg-gray-800 text-white rounded-md px-3 py-2 text-sm ml-3"
                wire:click="performSearch">Buscar</button>
        </div>

        @if (!empty($teamMembers))
            <div class="rounded-md border relative border-sky-500 bg-white overflow-x-hidden mt-6 shadow-md">
                <table class="w-full table-auto divide-y divide-gray-200 overflow-hidden rounded-md">
                    <thead class="bg-sky-500 text-white">
                        <tr class="text-xs">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Equipo/Cargo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Nombres</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Efect.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Rech.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                INC</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                NEC</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Temp.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Deso.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Dest.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Const.</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($teamMembers as $member)
                            <tr class="text-xs hover:text-white hover:bg-sky-400">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-center font-medium">
                                        {{ $member->equipment->name }}
                                    </div>
                                    <div class="text-center">
                                        @switch($member->role)
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
                                                    Supervisor Calidad
                                                </span>
                                            @break

                                            @case('campo')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Supervisor Campo
                                                </span>
                                            @break

                                            @case('encuestador')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-sky-800">
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
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $member->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-green-500 text-white font-medium flex justify-center items-center">
                                        {{ $member->total_efectivas ? $member->total_efectivas : '--' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_rechazo ? $member->total_rechazo : '--' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_informante ? $member->total_informante : '--' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_nadie_en_casa ? $member->total_nadie_en_casa : '--' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_temporal ? $member->total_temporal : '--' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_desocupada ? $member->total_desocupada : '--' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_destruida ? $member->total_destruida : '--' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $member->total_construccion ? $member->total_construccion : '--' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-sky-500 text-white font-medium flex justify-center items-center">
                                        {{ $member->total_efectivas + $member->total_rechazo + $member->total_informante + $member->total_nadie_en_casa }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
