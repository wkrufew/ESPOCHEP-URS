<?php

namespace App\Livewire\Admin;

use App\Models\Phase;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\On; 

class FaseComponent extends Component
{
    public $phases, $phase, $fecha_fin;

    public $createForm = [
        'name' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];

    public $editForm = [
        'open' => false,
        'name' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
    ];

    protected $validationAttributes = [
        'createForm.name' => 'name',
        'createForm.fecha_inicio' => 'fecha_inicio',
        'createForm.fecha_fin' => 'fecha_fin',
    ];

    public function mount(){
        $this->getPhases();
    }

    public function getPhases(){
        $this->phases = Phase::all();
    }

    public function save(){

        $this->validate([
            "createForm.name" => 'required|string|min:1',
            "createForm.fecha_inicio" => 'required',
            "createForm.fecha_fin" => 'required'
        ]);

        $ultimaFase = Phase::orderByDesc('id')->first(); // Obtener la última planificación por ID

        if ($ultimaFase) {
            $ultimoNombre = $ultimaFase->name;
            $lastNumber = (int) substr($ultimoNombre, 5); // Extraer el número de la parte derecha del código (FASE_01 => 1)
            $nextNumber = $lastNumber + 1;
            $nextCode = 'Fase ' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        } else {
            $nextCode = 'Fase 01';
        }
        
        $this->createForm['name'] = $nextCode;

        Phase::create($this->createForm);

        $this->reset('createForm');

        $this->getPhases();

        $this->dispatch('saved');
    }

    public function edit(Phase $phase){
        $this->phase = $phase;
        $this->editForm['open'] = true;
        $this->editForm['name'] = $phase->name;
        $this->editForm['fecha_inicio'] = $phase->fecha_inicio;
        $this->editForm['fecha_fin'] = $phase->fecha_fin;
    }

    public function update(){
        $this->phase->name = $this->editForm['name'];
        $this->phase->fecha_inicio = $this->editForm['fecha_inicio'];
        $this->phase->fecha_fin = $this->editForm['fecha_fin'];
        $this->phase->save();

        $this->reset('editForm');
        $this->getPhases();
    }

    #[On('phase-delete')]
    public function phaseDelete(Phase $phase){
        $phase->delete();
        $this->getPhases();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.fase-component');
    }
}
