<?php

namespace App\Livewire\Admin;

use App\Models\Assignment;
use App\Models\Equipment;
use App\Models\Planning;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditAsignacion extends Component
{
    public Assignment $assignment;

    #[Rule('required')]
    public $code;

    #[Rule('required')]
    public $equipment_id;

    #[Rule('required')]
    public $planning_id;
 
    #[Rule('required')]
    public $status;

    public $equipos = [];

    public $planificaciones = [];

    public function mount(){

        $this->equipos = Equipment::all();
        $this->planificaciones = Planning::all();

        $this->fill(
            $this->assignment->only('code','equipment_id','planning_id','status'),
        );
    }

    public function save(){

        $this->validate();
        //dd( $this->validate());

        $this->assignment->update([
            'code' => $this->code,
            'equipment_id' => $this->equipment_id,
            'planning_id' => $this->planning_id,
            'status' => $this->status,
        ]);
        
        $this->dispatch('saved');
    }

    #[On('asignacion-delete')]
    public function deleteAsignacion($assignment){
        $asignacion = Assignment::findOrFail($assignment);
        $asignacion->delete();
        return redirect()->route('admin.asignaciones.index');
    }


    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.edit-asignacion');
    }
}
