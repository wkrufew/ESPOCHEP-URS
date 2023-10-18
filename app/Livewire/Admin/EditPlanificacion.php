<?php

namespace App\Livewire\Admin;

use App\Models\Canton;
use App\Models\Equipment;
use App\Models\Parish;
use App\Models\Phase;
use App\Models\Planning;
use App\Models\Province;
use App\Models\Sector;
use App\Models\Zone;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Validator;

class EditPlanificacion extends Component
{
    public Planning $planning;

    #[Rule('required')]
    public $code;  

    #[Rule('required')]
    public $provincia;
 
    #[Rule('required')]
    public $canton;

    #[Rule('required')]
    public $parroquia;

    #[Rule('required')]
    public $dpa;

    #[Rule('required')]
    public $areacensal;

    #[Rule('required')]
    public $codigo_manzana;

    #[Rule('required')]
    public $tipo_sector;

    #[Rule('required')]
    public $hogares_planificados;

    #[Rule('required')]
    public $fecha_inicio;
    
    #[Rule('required')]
    public $fecha_fin;
    
    #[Rule('required')]
    public $dias;

    #[Rule('required')]
    public $phase_id;
    
    #[Rule('required')]
    public $equipment_id;

    #[Rule('required')]
    public $status;     
    
    public $fases = [];
    
    public $equipos = [];

    public function mount(){
        $this->fases = Phase::all();

        $this->equipos = Equipment::all();

        $this->fill(
            $this->planning->only('status','code','provincia','canton','parroquia','dpa','parroquia','areacensal','codigo_manzana','tipo_sector','hogares_planificados','fecha_inicio','fecha_fin','dias', 'phase_id','equipment_id'),
        );
    }


    public function refreshPlanning(){
        $this->planning = $this->planning->fresh();
    }

    public function save(){

        $this->validate();

        $this->planning->update([
            'code' => $this->code,
            'provincia' => $this->provincia,
            'canton' => $this->canton,
            'parroquia' => $this->parroquia,
            'dpa' => $this->dpa,
            'areacensal' => $this->areacensal,
            'codigo_manzana' => $this->codigo_manzana,
            'tipo_sector' => $this->tipo_sector,
            'hogares_planificados' => $this->hogares_planificados,
            'dias' => $this->dias,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'status' => $this->status,
            'phase_id' => $this->phase_id,
            'equipment_id' => $this->equipment_id,
            
        ]);
        
        $this->dispatch('saved');
    }

    #[On('planificacion-delete')]
    public function deletePlanificacion($planning){
        $planificacion = Planning::findOrFail($planning);
        $planificacion->delete();
        return redirect()->route('admin.planificaciones.index');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.edit-planificacion');
    }
}
