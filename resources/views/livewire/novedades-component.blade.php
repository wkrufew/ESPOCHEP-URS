<div>
    <div wire:loading>
        <x-loading message="Cargando datos..."/>
    </div>
    <div class="max-w-6xl mx-auto bg-white rounded-md p-4 mt-4">
        <h2 class="text-center py-4 font-semibold">CONSULTA DE NOVEDADES</h2>
        <div class="max-w-xs mx-auto p-4 mt-4">
            <x-label>
                Codigo de Sector/Manzana
            </x-label>
            <x-input wire:model="search" type="text" placeholder="17025399900300" class="w-full mt-1" />
            <x-input-error for="search" />
        </div>
        <div class="p-4 flex justify-center">
            <button class="px-4 py-2 rounded-full bg-gray-800 text-white" wire:click="consultar">Consultar</button>
        </div>
    </div>
    @if ($visible)
        <div class="max-w-6xl mx-auto bg-white rounded-md p-4 mt-4">
            @if (!empty($resultados))
                <h3 class="text-center uppercase font-semibold">Resultados</h3>
                <div>
                    <hr>
                    @foreach ($resultados as $resultado)
                        <p class="mt-3"><b>Fase: </b> {{ $resultado->fase }}</p>
                        <p><b>Provincia: </b> {{ $resultado->provincia }}</p>
                        <p><b>Canton: </b> {{ $resultado->canton }}</p>
                        <p><b>Parroquia: </b> {{ $resultado->parroquia }}</p>
                        <p><b>Codigo de Sector/Manzana: </b> {{ $resultado->codigo_manzana }}</p>
                        <p><b>Hogares Planificados: </b> {{ $resultado->hogares_p }}</p>
                        <p><b>Hogares Identificados: </b> {{ $resultado->hogares_i }}</p>
                        <p><b>dipticos entregados: </b> {{ $resultado->dipticos }}</p>
                        <p><b>Observacion: </b> {{ $resultado->observacion }}</p>
                        <p><b>Estado: </b> <span class="bg-green-800 text-gray-100 rounded-full px-3 py-1 text-sm">{{ $resultado->status }}</span></p>
                        <br>
                        <b>Responsable</b>
                        <p><b>Socializador: </b> {{ $resultado->user->name }}</p>
                        <p><b>Fecha de publicacion: </b> {{ $resultado->created_at }}</p>
                    @endforeach
                </div>
            @else
              no se encontraron resultados
            @endif
        </div>
    @else
        @if (!empty($mensaje))
            <div class="max-w-6xl mx-auto bg-white rounded-md p-4 mt-4">
                {{ $mensaje }}
            </div>
        @endif
    @endif
</div>
