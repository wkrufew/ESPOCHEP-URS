<?php

namespace App\Livewire\Admin;

use App\Models\Assignment;
use App\Models\Equipment;
use App\Models\Planning;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateAsignacion extends Component
{
    public $equipos = [];
    public $planificaciones = [];

    #[Rule('required')] 
    public $equipment_id='';

    #[Rule('required')] 
    public $planning_id='';

    public function mount(){
        $this->equipos = Equipment::all();
        $this->planificaciones = Planning::all();
    }

    public function save(){

        $lastAsignacion = Assignment::orderByDesc('id')->first(); // Obtener la última planificación por ID
        if ($lastAsignacion) {
            $lastCode = $lastAsignacion->code;
            $lastNumber = (int) substr($lastCode, 2); // Extraer el número de la parte derecha del código (P-001 => 1)
            $nextNumber = $lastNumber + 1;
            $nextCode = 'A-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT); // Generar el siguiente código (P-002, P-003, ...)
        } else {
            $nextCode = 'A-0001'; // Si no hay planificaciones anteriores, comenzar desde P-001
        }

        $this->validate();

        $assignment = new Assignment();
        $assignment->equipment_id = $this->equipment_id;
        $assignment->planning_id = $this->planning_id;
        $assignment->code = $nextCode ;

        //dd($assignment);
        $assignment->save();

        return redirect()->route('admin.asignaciones.edit', $assignment);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.create-asignacion');
    }
}
