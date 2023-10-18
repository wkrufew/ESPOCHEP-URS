<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\Phase;
use App\Models\Planning;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

class CreatePlanificacion extends Component
{
    public $fases = [];
    public $equipos = [];
    public $provincia;
    public $canton;
    public $parroquia;
    public $dpa;
    public $areacensal;
    public $codigo_manzana;
    public $tipo_sector;
    public $hogares_planificados;
    public $fecha_fin;
    public $fecha_inicio;
    public $dias;
    public $phase_id = "";
    public $equipment_id = "";

    protected $rules = [
        'provincia' => 'required',
        'canton' => 'required',
        'parroquia' => 'required',
        'dpa' => 'required',
        'areacensal' => 'required',
        'codigo_manzana' => 'required',
        'tipo_sector' => 'required',
        'hogares_planificados' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'dias' => 'required',
        'phase_id' => 'required',
        'equipment_id' => 'required'
    ];
    
    public function mount(){
        $this->fases = Phase::all();
        $this->equipos = Equipment::all();
    }

    public function save(){
    
        $lastPlanification = Planning::orderByDesc('id')->first(); // Obtener la última planificación por ID

        if ($lastPlanification) {
            $lastCode = $lastPlanification->code;
            $lastNumber = (int) substr($lastCode, 2); // Extraer el número de la parte derecha del código (P-001 => 1)
            $nextNumber = $lastNumber + 1;
            $nextCode = 'P-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT); // Generar el siguiente código (P-002, P-003, ...)
        } else {
            $nextCode = 'P-0001'; // Si no hay planificaciones anteriores, comenzar desde P-001
        }

        $this->validate();

        $planning = new Planning();
        $planning->code = $nextCode;
        $planning->provincia = $this->provincia;
        $planning->canton = $this->canton;
        $planning->parroquia = $this->parroquia;
        $planning->dpa = $this->dpa;
        $planning->areacensal = $this->areacensal;
        $planning->codigo_manzana = $this->codigo_manzana;
        $planning->tipo_sector = $this->tipo_sector;
        $planning->hogares_planificados = $this->hogares_planificados;
        $planning->fecha_inicio = $this->fecha_inicio;
        $planning->fecha_fin = $this->fecha_fin;
        $planning->dias = $this->dias;
        $planning->phase_id = $this->phase_id;
        $planning->equipment_id = $this->equipment_id;

        $planning->save();

        return redirect()->route('admin.planificaciones.edit', $planning);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.create-planificacion');
    }
}
