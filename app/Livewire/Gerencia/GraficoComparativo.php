<?php

namespace App\Livewire\Gerencia;

use App\Models\Phase;
use App\Models\Planning;
use App\Models\Worker;
use Livewire\Attributes\Layout;
use Livewire\Component;

class GraficoComparativo extends Component
{
    public $chartData;
    public $selectedPhase;

    public $efectivas;
    public $rechazos;
    public $nadie_en_casas;
    public $informante_no_calificados;
    public $temporales;
    public $desocupadas;
    public $destruidas;
    public $construcciones;
    public $hogaresplanificados;

    public function mount()
    {
        $this->selectedPhase = null;
    }

    #[Layout('layouts.gerencia')]
    public function render()
    {
        $phases = Phase::all();
        $provinces = Planning::query();

        if ($this->selectedPhase) {
            $provinces->where('phase_id', $this->selectedPhase);
        }
        //INICIO HOGARES PLANIFICADOS
        if ($this->selectedPhase) {
            $this->hogaresplanificados = Planning::where('phase_id', $this->selectedPhase)->sum('hogares_planificados');
        }
        //FIN HOGARES PLANIFICADOS

        $provinces = $provinces->get();

        ///INICIO TOTALES
        $efectivasTotal = 0;
        $rechazoTotal = 0;
        $informanteNoCalificadoTotal = 0;
        $nadieEnCasaTotal = 0;
        $temporalTotal = 0;
        $desocupadaTotal = 0;
        $destruidaTotal = 0;
        $construccionTotal = 0;

        foreach ($provinces as $province) {
            $efectivasTotal += Worker::where('planning_id', $province->id)->sum('efectivas');
            $rechazoTotal += Worker::where('planning_id', $province->id)->sum('rechazo');
            $informanteNoCalificadoTotal += Worker::where('planning_id', $province->id)->sum('informante_no_calificado');
            $nadieEnCasaTotal += Worker::where('planning_id', $province->id)->sum('nadie_en_casa');
            $temporalTotal += Worker::where('planning_id', $province->id)->sum('temporal');
            $desocupadaTotal += Worker::where('planning_id', $province->id)->sum('desocupada');
            $destruidaTotal += Worker::where('planning_id', $province->id)->sum('destruida');
            $construccionTotal += Worker::where('planning_id', $province->id)->sum('construccion');
        }

        // Asigna los totales a las variables
        $this->efectivas = $efectivasTotal;
        $this->rechazos = $rechazoTotal;
        $this->informante_no_calificados = $informanteNoCalificadoTotal;
        $this->nadie_en_casas = $nadieEnCasaTotal;
        $this->temporales = $temporalTotal;
        $this->desocupadas = $desocupadaTotal;
        $this->destruidas = $destruidaTotal;
        $this->construcciones = $construccionTotal;
        ///FIN DE TOTALES

        $data = [];

        foreach ($provinces as $province) {
            $totals = [
                'efectivas' => Worker::where('planning_id', $province->id)->sum('efectivas'),
                'rechazo' => Worker::where('planning_id', $province->id)->sum('rechazo'),
                'informante_no_calificado' => Worker::where('planning_id', $province->id)->sum('informante_no_calificado'),
                'nadie_en_casa' => Worker::where('planning_id', $province->id)->sum('nadie_en_casa'),
                'temporal' => Worker::where('planning_id', $province->id)->sum('temporal'),
                'desocupada' => Worker::where('planning_id', $province->id)->sum('desocupada'),
                'destruida' => Worker::where('planning_id', $province->id)->sum('destruida'),
                'construccion' => Worker::where('planning_id', $province->id)->sum('construccion'),
            ];

            // Agrupa los totales por provincia
            if (isset($data[$province->provincia])) {
                foreach ($totals as $key => $value) {
                    $data[$province->provincia]['totals'][$key] += $value;
                }
            } else {
                $data[$province->provincia] = [
                    'province' => $province->provincia,
                    'totals' => $totals,
                ];
            }
        }

        $this->chartData = json_encode(array_values($data));

        return view('livewire.gerencia.grafico-comparativo', compact('phases'));
    }
}
