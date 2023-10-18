<div class="max-w-5xl mx-auto px-4 py-10">
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="mb-4">
        <x-label value="Buscar Sticker" />
        <x-input type="text" wire:model.live.debounce.500ms="search" class="w-full" placeholder="Ingrese el código del sticker" />
    </div>

    <div>
        @if ($stickers->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
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
                        Equipo
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Encuestador
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($stickers as $sticker)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $sticker->code }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @switch($sticker->status)
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
                                {{ $sticker->equipment->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ optional($sticker->user)->name }}
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
    @if ($stickers->hasPages())
        <div class="px-6 py-4">
            {{ $stickers->links() }}
        </div>
    @endif
</div>
