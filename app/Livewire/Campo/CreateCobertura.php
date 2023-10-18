<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use App\Models\Planning;
use App\Models\Sticker;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateCobertura extends Component
{
    public $planificaciones = [];
    public $dia;
    public $fecha_encuesta;
    public $observacion;
    public $asignacion_datos;
    public $selectedTipo = "";
    public $planning_id = "";
    public $certificado_id = "";
    public $usuario;
    public $fecha_inicio;
    public $fecha_fin;
    public $asignacionSeleccionada = false;
    public $fechaSeleccionada = false;
    public $certificadoSeleccionado = false;
    public $mensaje = "";
    public $fecha_ip;
    public $fecha_fp;
    //para buscadores
    public $searchCertificados = '';
    public $searchStickers = '';
    public $selectedCertificado = null;
    public $selectedSticker = null;
    public $limit = 5;
    public $open1 = false;
    public $open2 = false;

    protected $rules = [
        'planning_id' => 'required',
        'observacion' => 'required',
        'fecha_encuesta' => 'required|date',
        'selectedTipo' => 'required'
    ];

    public function mount()
    {
        $this->planificaciones = [];
        $this->usuario = auth()->user();

        $this->planificaciones = Planning::whereNotIn('status', ['0', '2'])->where('equipment_id', $this->usuario->equipment_id)->get();
        $this->fechaSeleccionada = false;
    }

    public function updatedSearchCertificados($value)
    {
        if ($value) {
            $this->open1 = true;
        } else {
            $this->open1 = false;
        }
    }
    public function updatedSearchStickers($value)
    {
        if ($value) {
            $this->open2 = true;
        } else {
            $this->open2 = false;
        }
    }

    public function seleccionarCertificado($certificadoId)
    {
        $this->selectedCertificado = Certificado::find($certificadoId);
        $this->searchCertificados = '';
    }

    public function seleccionarSticker($stickerId)
    {
        $this->selectedSticker = Sticker::find($stickerId);
        $this->searchStickers = '';
    }

    public function updatedPlanningId($value)
    {
        if ($value) {
            $this->asignacion_datos = Planning::find($value);
            $this->fecha_encuesta = null;
            $this->dia = null;
            $this->asignacionSeleccionada = true;
        }
    }

    public function updatedFechaEncuesta($value)
    {
        if ($value && $this->asignacion_datos) {
            $this->fecha_inicio = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->phase->fecha_inicio);
            $this->fecha_fin = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->phase->fecha_fin);

            ///NUEVO VALIDACION FECHA PLANIFICACION
            $this->fecha_ip = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->fecha_inicio);
            $this->fecha_fp = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->fecha_fin);
            ////

            $fecha_elegida = Carbon::createFromFormat('Y-m-d', $value);

            if (!$fecha_elegida->between($this->fecha_ip, $this->fecha_fp)) {
                // La fecha no está dentro del rango, restablecer fecha_encuesta a null.
                $this->fecha_encuesta = null;
                $this->mensaje = "La fecha esta fuera de planificacion";
                $this->dia = null;
            } else {
                // La fecha está dentro del rango, calcular el día.
                $this->mensaje = "";
                $this->fecha_inicio = $this->fecha_inicio;
                $this->dia = $this->fecha_inicio->diffInDays($fecha_elegida) + 1;

                $this->fechaSeleccionada = true;                
            }
        }
    }

    public function updatedSelectedTipo($value)
    {
        $this->selectedTipo = $value;

        if ($this->selectedTipo !== 'efectivas') {
            $this->certificado_id = null;
        }
    }

    public function save()
    {
        $this->validate($this->rules);

        $cobertura = new Worker([
            'user_id' => $this->usuario->id,
            'dia' => $this->dia,
            'fecha_encuesta' => $this->fecha_encuesta,
            'planning_id' => $this->planning_id,
            'observacion' => $this->observacion,
        ]);

        $this->setTipoAndCertificado($cobertura);
        $cobertura->save();

        $this->reset(['selectedTipo', 'asignacion_datos', 'planificaciones', 'certi', 'sticker']);

        return redirect()->route('campo.coberturas.index');
    }

    private function setTipoAndCertificado($cobertura)
    {
        $selectedTipo = $this->selectedTipo;

        if ($selectedTipo == 'efectivas') {
            $this->validate([
                'selectedCertificado' => 'required',
                'selectedSticker' => 'required',
            ]);
            $cobertura->efectivas = 1;
            $cobertura->certificado_id = $this->selectedCertificado->id;
            $cobertura->sticker_id = $this->selectedSticker->id;

            if ($this->selectedCertificado->id) {
                $certi = Certificado::find($this->selectedCertificado->id);
                if ($certi) {
                    $certi->update([
                        'status' => 'Ocupado',
                        'user_id' => $this->usuario->id,
                    ]);
                }
            }
            if ($this->selectedSticker->id) {
                $sticker = Sticker::find($this->selectedSticker->id);
                if ($sticker) {
                    $sticker->update([
                        'status' => 'Ocupado',
                        'user_id' => $this->usuario->id,
                    ]);
                }
            }
        } elseif ($selectedTipo == 'rechazo' || $selectedTipo == 'nadie_en_casa' || $selectedTipo == 'informante_no_calificado') {

            $cobertura->sticker_id = $this->selectedSticker->id;

            if ($this->selectedSticker->id) {
                $sticker = Sticker::find($this->selectedSticker->id);
                if ($sticker) {
                    $sticker->update([
                        'status' => 'Ocupado',
                        'user_id' => $this->usuario->id,
                    ]);
                }
            }

            $this->selectedCertificado = null;
            $this->reset(['selectedSticker', 'selectedCertificado']);
            $this->clearTipoFlags($cobertura);
            $cobertura->$selectedTipo = 1;
        }else {
            $this->selectedSticker = null;
            $this->selectedCertificado = null;
            $this->reset(['selectedSticker', 'selectedCertificado']);
            $this->clearTipoFlags($cobertura);
            $cobertura->$selectedTipo = 1;
        }
    }

    private function clearTipoFlags($cobertura)
    {
        $tipoFlags = ['temporal', 'construccion', 'destruida', 'desocupada', 'rechazo', 'informante_no_calificado', 'nadie_en_casa'];

        foreach ($tipoFlags as $flag) {
            $cobertura->$flag = 0;
        }
    }

    #[Layout('layouts.campo')]
    public function render()
    {
        $certificados = [];
        $stickers = [];

        if ($this->searchCertificados) {
            $certificados = Certificado::where('status', 'Disponible')
                ->where('equipment_id', $this->usuario->equipment_id)
                ->where('code', 'LIKE', '%' . $this->searchCertificados . '%')
                ->limit($this->limit)
                ->get();
        } elseif ($this->searchStickers) {
            $stickers = Sticker::whereIn('status', ['Disponible','Ocupado'])
                ->where('equipment_id', $this->usuario->equipment_id)
                ->where('code', 'LIKE', '%' . $this->searchStickers . '%')
                ->limit($this->limit)
                ->get();
        }

        return view('livewire.campo.create-cobertura', ['certificados' => $certificados, 'stickers' => $stickers]);
    }
}
