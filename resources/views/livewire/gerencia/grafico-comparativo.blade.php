<div class="max-w-7xl mx-auto bg-white p-4 rounded-md mt-4">
    <div>
        <div>
            <h2 class="text-lg font-semibold text-center mb-2 mt-1">
                GRAFICO TOTAL DE COBERTURAS POR PROVINCIA
            </h2>
            <div class="mb-2 mx-auto flex justify-center items-center">
                <label class="mr-3" for="phaseFilter">Fase:</label>
                <select class="border border-gray-300 rounded-md" wire:model.live="selectedPhase" id="phaseFilter">
                    <option value="">Seleccione una fase</option>
                    @foreach ($phases as $phase)
                        <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                    @endforeach
                </select>
            </div>
            <div wire:loading>
                <x-loading message="Cargando datos..." />
            </div>
        </div>
        <div>
            <h1 class="text-center font-semibold uppercase">
                Valores generales
            </h1>
            <div class="flex justify-between text-sm p-4 rounded-md border shadow-md font-medium">
                <div>
                    <div class="flex justify-between space-x-6">
                        <div>Efectivas: <span> {{ $efectivas }}</span></div>
                        <div>Nadie en Casas: <span> {{ $nadie_en_casas }}</span></div>
                        <div>Informantes NC: <span> {{ $informante_no_calificados }}</span></div>
                        <div>Rechazos: <span> {{ $rechazos }}</span></div>
                    </div>
                    <div class="flex justify-evenly font-semibold mt-2">
                        <span>
                            Total: {{ $efectivas + $nadie_en_casas + $informante_no_calificados + $rechazos }}
                        </span>
                        <span>
                            Hogares P.: {{ $hogaresplanificados }}
                        </span>
                        @php
                            $hogaresProyectados = $hogaresplanificados;
                            $hogaresConseguidos = $efectivas;
                            
                            $hogaresFaltantes = $hogaresConseguidos * 100;
                            if ($hogaresProyectados) {
                                $porcentajeFaltante = $hogaresFaltantes / $hogaresProyectados;
                            } else {
                                $porcentajeFaltante = 0;
                            }
                        @endphp
                        <div>
                            <div class="text-xs text-center">
                                Relacion Efectivas
                            </div>
                            <div
                                class="overflow-hidden h-6 text-xs flex rounded-md bg-gray-500 border border-neutral-700">
                                <div style="width: {{ $porcentajeFaltante . '%' }}"
                                    class="rounded-r-md shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                                @php
if ($porcentajeFaltante < 100) {
                                        echo 'bg-red-500';
                                    } elseif ($porcentajeFaltante == 100) {
                                        echo 'bg-blue-500';
                                    } else {
                                        echo 'bg-green-500 animate-pulse';
                                    } @endphp
                                    transition-all duration-700">
                                    <span class="text-xs p-1 text-center">
                                        {{ number_format($porcentajeFaltante, 2) . '%' . ' ' }} Completado
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div>
                            @php
                                $hogaresProyectados2 = $hogaresplanificados;
                                $hogaresConseguidos2 = $efectivas + $nadie_en_casas + $informante_no_calificados + $rechazos;
                                
                                $hogaresFaltantes2 = $hogaresConseguidos2 * 100;
                                if ($hogaresProyectados2) {
                                    $porcentajeFaltante2 = $hogaresFaltantes2 / $hogaresProyectados2;
                                } else {
                                    $porcentajeFaltante2 = 0;
                                }
                            @endphp
                            <div class="text-xs text-center">
                                Relacion General
                            </div>
                            <div
                                class="overflow-hidden h-6 text-xs flex rounded-md bg-gray-500 border border-neutral-700">
                                <div style="width: {{ $porcentajeFaltante2 . '%' }}"
                                    class="rounded-r-md shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center 
                                @php
                                    if ($porcentajeFaltante2 < 100) {
                                        echo 'bg-red-500';
                                    } elseif ($porcentajeFaltante2 == 100) {
                                        echo 'bg-blue-500';
                                    } else {
                                        echo 'bg-green-500 animate-pulse';
                                    } @endphp
                                    transition-all duration-700">
                                    <span class="text-xs p-1 text-center">
                                        {{ number_format($porcentajeFaltante2, 2) . '%' . ' ' }} Completado
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between space-x-6">
                        <div>Temporales: <span> {{ $temporales }}</span></div>
                        <div>Desocupadas: <span> {{ $desocupadas }}</span></div>
                        <div>Destruidas: <span> {{ $destruidas }}</span></div>
                        <div>Construcciones: <span> {{ $construcciones }}</span></div>
                    </div>
                    <div class="flex justify-center font-semibold mt-2">
                        Total: {{ $temporales + $desocupadas + $destruidas + $construcciones }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <canvas class="w-full" id="myChart" height="400"></canvas>
    </div>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("livewire:init", function() {

            function initializeChart() {
                var chartData = JSON.parse(@json($chartData));

                var provinces = chartData.map(data => data.province);
                var efectivas = chartData.map(data => data.totals.efectivas);
                var rechazo = chartData.map(data => data.totals.rechazo);
                var informante_no_calificado = chartData.map(data => data.totals.informante_no_calificado);
                var nadie_en_casa = chartData.map(data => data.totals.nadie_en_casa);
                var temporal = chartData.map(data => data.totals.temporal);
                var desocupada = chartData.map(data => data.totals.desocupada);
                var destruida = chartData.map(data => data.totals.destruida);
                var construccion = chartData.map(data => data.totals.construccion);

                // Define un conjunto de colores personalizados
                var colores = [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(0, 128, 0, 0.2)',
                    'rgba(255, 0, 255, 0.2)',
                    'rgba(0, 255, 0, 0.2)',
                    'rgba(255, 160, 122, 0.2)',
                    'rgba(0, 0, 255, 0.2)',
                ];

                // Define un conjunto de colores de borde
                var coloresBorde = [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(0, 128, 0, 1)',
                    'rgba(255, 0, 255, 1)',
                    'rgba(0, 255, 0, 1)',
                    'rgba(255, 160, 122, 1)',
                    'rgba(0, 0, 255, 1)',
                ];

                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: provinces,
                        datasets: [{
                                label: 'Efectivas',
                                data: efectivas,
                                backgroundColor: colores[0],
                                borderColor: coloresBorde[0],
                                borderWidth: 1
                            },
                            {
                                label: 'Rechazo',
                                data: rechazo,
                                backgroundColor: colores[1],
                                borderColor: coloresBorde[1],
                                borderWidth: 1
                            },
                            {
                                label: 'Informante No Calificado',
                                data: informante_no_calificado,
                                backgroundColor: colores[2],
                                borderColor: coloresBorde[2],
                                borderWidth: 1
                            },
                            {
                                label: 'Nadie en Casa',
                                data: nadie_en_casa,
                                backgroundColor: colores[3],
                                borderColor: coloresBorde[3],
                                borderWidth: 1
                            },
                            {
                                label: 'Temporales',
                                data: temporal,
                                backgroundColor: colores[4],
                                borderColor: coloresBorde[4],
                                borderWidth: 1
                            },
                            {
                                label: 'Desocupadas',
                                data: desocupada,
                                backgroundColor: colores[5],
                                borderColor: coloresBorde[5],
                                borderWidth: 1
                            },
                            {
                                label: 'Destruidas',
                                data: destruida,
                                backgroundColor: colores[6],
                                borderColor: coloresBorde[6],
                                borderWidth: 1
                            },
                            {
                                label: 'Construcciones',
                                data: construccion,
                                backgroundColor: colores[7],
                                borderColor: coloresBorde[7],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }

            /* function calcularTotalesEfectivas(efectivas) {
                return efectivas.reduce((a, b) => a + b, 0);
            } */

            initializeChart();



        });
    </script>
@endpush
</div>
