<?php

namespace App\Livewire\Encuestador;

use App\Models\Assignment;
use App\Models\Certificado;
use App\Models\Planning;
use App\Models\Sticker;
use App\Models\Worker;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditCobertura extends Component
{
    public Worker $worker;

    public $planificaciones = [];
    public $dia;
    #[Rule('required')]
    public $fecha_encuesta;
    #[Rule('required')]
    public $observacion;
    public $asignacion_datos;
    #[Rule('required')]
    public $selectedTipo = "";
    #[Rule('required')]
    public $planning_id = "";
    public $certificado_id = "";
    public $sticker_id = "";
    public $usuario;
    public $fecha_inicio;
    public $fecha_fin;
    public $fecha_ip;
    public $fecha_fp;
    public $asignacionSeleccionada = false;
    public $mensaje = "";
    public $certificadoViejo = "";
    public $stickerViejo = null;
    public $mensajecertificado = "";
    public $mensajesticker = "";
    //para buscadores
    public $searchCertificados = '';
    public $searchStickers = '';
    public $selectedCertificado = null;
    public $selectedSticker = null;
    public $limit = 5;
    public $open1 = false;
    public $open2 = false;

    public function updatedSearchCertificados($value)
    {
        if ($value) {
            //dd($value);
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

    public function mount()
    {
        $this->usuario = auth()->user();

        $this->planificaciones = Planning::whereNotIn('status', ['0','2'])->where('equipment_id', $this->usuario->equipment_id)->get();

        $this->fill(
            $this->worker->only('planning_id', 'fecha_encuesta', 'efectivas', 'temporal', 'desocupada', 'construccion', 'nadie_en_casa', 'informante_no_calificado', 'destruida', 'rechazo', 'observacion', 'dia', 'certificado_id', 'sticker_id'),
        );

        $certif = Certificado::find($this->certificado_id);
        if ($certif) {
            $this->selectedCertificado = $certif;
        }
        $stic = Sticker::find($this->sticker_id);
        if ($stic) {
            $this->selectedSticker = $stic;
        }

        if ($this->worker->efectivas == 1) {
            $this->selectedTipo = "efectivas";
        } elseif ($this->worker->temporal == 1) {
            $this->selectedTipo = "temporal";
        } elseif ($this->worker->desocupada == 1) {
            $this->selectedTipo = "desocupada";
        } elseif ($this->worker->destruida == 1) {
            $this->selectedTipo = "destruida";
        } elseif ($this->worker->rechazo == 1) {
            $this->selectedTipo = "rechazo";
        } elseif ($this->worker->nadie_en_casa == 1) {
            $this->selectedTipo = "nadie_en_casa";
        } elseif ($this->worker->informante_no_calificado == 1) {
            $this->selectedTipo = "informante_no_calificado";
        } elseif ($this->worker->construccion == 1) {
            $this->selectedTipo = "construccion";
        }

        if ($this->worker->certificado_id) {
            $this->certificadoViejo =  $this->worker->certificado_id;
        }
        if ($this->worker->sticker_id) {
            $this->stickerViejo =  $this->worker->sticker_id;
        }

        $this->asignacion_datos = Planning::find($this->planning_id);

        if ($this->asignacion_datos) {
            $this->asignacionSeleccionada = true;
        }
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
        //dd($this->asignacion_datos);
        //cambiar la fecha no de la planificacion si no de la fase
        if ($value && $this->asignacion_datos) {
            $this->fecha_inicio = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->phase->fecha_inicio);
            $this->fecha_fin = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->phase->fecha_fin);
            $fecha_elegida = Carbon::createFromFormat('Y-m-d', $value);
            
            ///NUEVO VALIDACION FECHA PLANIFICACION
            $this->fecha_ip = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->fecha_inicio);
            $this->fecha_fp = Carbon::createFromFormat('Y-m-d', $this->asignacion_datos->fecha_fin);
            ////
            //!$fecha_elegida->between($this->fecha_ip, $this->fecha_fp)
            if (!$fecha_elegida->between($this->fecha_ip, $this->fecha_fp)) {
                // La fecha no está dentro del rango, restablecer fecha_encuesta a null.
                $this->fecha_encuesta = null;
                $this->mensaje = "La fecha esta fuera de rango";
                $this->dia = null;
            } else {
                // La fecha está dentro del rango, calcular el día.
                $this->mensaje = "";
                $this->fecha_inicio = $this->fecha_inicio;
                $this->dia = $this->fecha_inicio->diffInDays($fecha_elegida) + 1;
            }
        }
    }

    public function refreshWorker()
    {
        $this->worker = $this->worker->fresh();
    }

    public function save()
    {
        $this->validate();

        $this->validateCertificado();

        $this->validateSticker();

        $this->updateCertificadoStatus();

        $this->updateStickerStatus();

        $this->setEncuestaFlags();

        $this->updateWorker();

        $this->dispatch('saved');
        return redirect()->route('encuestador.coberturas.index');
    }

    private function validateCertificado()
    {
        if ($this->selectedTipo == 'efectivas') {
            $this->validate([
                'selectedCertificado' => 'required|unique:workers,certificado_id,' . $this->worker->id
            ]);
            
        } else {
            $this->selectedCertificado = null;
        }
    }

    private function validateSticker()
    {
        if ($this->selectedTipo == 'efectivas' || $this->selectedTipo == 'rechazo' || $this->selectedTipo == 'nadie_en_casa' || $this->selectedTipo == 'informante_no_calificado') {
            $this->validate([
                'selectedSticker' => 'required'/* |unique:workers,sticker_id,' . $this->worker->id */,
            ]);
        } else {
            $this->selectedSticker = null;
        }
    }

    private function updateCertificadoStatus()
    {
        if ($this->certificadoViejo != null) {
            Certificado::find($this->certificadoViejo)->update([
                'status' => 'Disponible',
                'user_id' => null
            ]);
        }
        if ($this->selectedCertificado != null) {
            Certificado::find($this->selectedCertificado->id)->update([
                'status' => 'Ocupado',
                'user_id' => $this->usuario->id
            ]);
        }
    }

    private function updateStickerStatus()
    {
        if ($this->stickerViejo != null) {
            Sticker::find($this->stickerViejo)->update([
                'status' => 'Disponible',
                'user_id' => null
            ]);
        }
        if ($this->selectedSticker != null) {
            Sticker::find($this->selectedSticker->id)->update([
                'status' => 'Ocupado',
                'user_id' => $this->usuario->id
            ]);
        }
    }

    private function setEncuestaFlags()
    {
        $encuestaFlags = [
            'efectivas' => 0,
            'temporal' => 0,
            'construccion' => 0,
            'destruida' => 0,
            'desocupada' => 0,
            'rechazo' => 0,
            'informante_no_calificado' => 0,
            'nadie_en_casa' => 0,
        ];

        if (isset($encuestaFlags[$this->selectedTipo])) {
            $encuestaFlags[$this->selectedTipo] = 1;
        }

        foreach ($encuestaFlags as $key => $value) {
            $this->worker->$key = $value;
        }
    }

    private function updateWorker()
    {
        $this->worker->update([
            'fecha_encuesta' => $this->fecha_encuesta,
            'dia' => $this->dia,
            'observacion' => $this->observacion,
            'planning_id' => $this->planning_id,
            'certificado_id' => $this->selectedCertificado ? $this->selectedCertificado->id : null,
            'sticker_id' => $this->selectedSticker ? $this->selectedSticker->id : null,
        ]);
    }

    #[Layout('layouts.encuestador')]
    public function render()
    {
        $certificados = [];
        $stickers = [];

        if ($this->searchCertificados) {
            $certificados = Certificado::where('equipment_id', $this->usuario->equipment_id)
                ->where('code', 'LIKE', '%' . $this->searchCertificados . '%')
                ->limit($this->limit)
                ->get();
        } elseif ($this->searchStickers) {
            $stickers = Sticker::where('equipment_id', $this->usuario->equipment_id)
                ->where('code', 'LIKE', '%' . $this->searchStickers . '%')
                ->limit($this->limit)
                ->get();
        }

        return view('livewire.encuestador.edit-cobertura', ['certificados' => $certificados, 'stickers' => $stickers]);
    }
}
