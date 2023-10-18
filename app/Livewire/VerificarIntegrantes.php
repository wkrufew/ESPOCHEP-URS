<?php

namespace App\Livewire;

use App\Models\Equipment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificarIntegrantes extends Component
{
    public $teamName = ''; // Para ingresar el nombre del equipo
    public $users = []; // Aquí almacenaremos los usuarios del equipo
    public $errorMessage = '';

    public function searchMembers()
    {
        // Buscar el equipo por nombre
        $equipment = Equipment::where('name', $this->teamName)->first();

        if ($equipment) {
            // Obtener los usuarios que pertenecen al equipo
            $this->users = User::where('status', 'activo')->where('equipment_id', $equipment->id)->get();
            $this->errorMessage = '';
        } else {
            // Equipo no encontrado
            $this->users = [];
            $this->errorMessage = 'Equipo no encontrado.';
        }
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.verificar-integrantes');
    }
}
