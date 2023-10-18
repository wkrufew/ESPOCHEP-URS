<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\Phase;
use App\Models\Planning;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SearchPlannings extends Component
{
    public $equipmentNumber;
    public $planifications;
    public $phases;
    public $visible = false;
    public $errorMessage='';
    
    public function search()
    {
        //dd($this->phases);
        $this->validate([
            'equipmentNumber' => 'required',
            'phases' => 'required',
        ]);

        $equipment = Equipment::where('name', $this->equipmentNumber)->first();

        if ($equipment && $this->phases) {
            $this->planifications = Planning::where('phase_id',$this->phases)->where('equipment_id', $equipment->id)->get();
        } else {
            $this->planifications = [];
            $this->errorMessage = 'Equipo no encontrado.';
            return;
        }

        if (count($this->planifications)) {
            $this->visible = true;
            $this->errorMessage = '';
        } else {
            $this->visible = false;
            $this->errorMessage = 'El equipo no tiene asignado planificaciones';
        }
    }
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.search-plannings', ['fases' => Phase::all()]);
    }
}
