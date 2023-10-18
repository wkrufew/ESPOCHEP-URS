<div class="max-w-5xl mx-auto px-4 py-10">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="mb-4">
        <x-label value="Buscar Certificado" />
        <x-input type="text" wire:model.live.debounce.500ms="search" class="w-full" placeholder="Ingrese el código del certificado" />
    </div>

    <div>
        @if ($certificados->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Equipo
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Codigo
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fecha Creacion
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($certificados as $certificado)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $certificado->equipment->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $certificado->code }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @switch($certificado->status)
                                        @case('Disponible')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Disponible
                                            </span>
                                        @break
                                        @case('Ocupado')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Ocupado
                                            </span>
                                        @break
                                        @case('Danado')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Dañado
                                            </span>
                                        @break
                                        @case('Anulado')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Anulado
                                            </span>
                                        @break
                                        
                                        @default
                                    @endswitch
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $certificado->created_at }}
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    @else
        <div class="px-6 py-4">
            No hay ningún registro coincidente
        </div>
    @endif
    </div>
    @if ($certificados->hasPages())
        <div class="px-6 py-4">
            {{ $certificados->links() }}
        </div>
    @endif
</div>
