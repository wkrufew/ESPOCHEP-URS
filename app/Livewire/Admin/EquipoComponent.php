<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class EquipoComponent extends Component
{
    use WithPagination;

    public $search;
    public $equipments;

    public function mount(){
        $this->getEquipments();
    }

    public function getEquipments(){
        $this->equipments = Equipment::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('equipment-delete')]
    public function equipmentDelete(Equipment $equipment)
    {
        $equipment->delete();
        $this->getEquipments();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $equipos = Equipment::where('name', 'like', '%' . $this->search . '%')
                                ->paginate(10);


        return view('livewire.admin.equipo-component', compact('equipos'));
    }

    /* $ultimoEquipo = Equipment::orderByDesc('id')->first(); // Obtener la última planificación por ID

        if ($ultimoEquipo) {
            $ultimoNombre = $ultimoEquipo->name;
            $lastNumber = (int) substr($ultimoNombre, 2); // Extraer el número de la parte derecha del código (P001 => 1)
            $nextNumber = $lastNumber + 1;
            $nextCode = 'E-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // Generar el siguiente código (P002, P003, ...)
        } else {
            $nextCode = 'E-001'; // Si no hay planificaciones anteriores, comenzar desde P001
        } */
}
