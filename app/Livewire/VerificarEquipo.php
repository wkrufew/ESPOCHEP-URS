<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerificarEquipo extends Component
{
    public $searchQuery = ''; // Para la cédula o nombre del usuario
    public $user = null; // Aquí almacenaremos los datos del usuario encontrado
    public $errorMessage = ''; // Para mostrar mensajes de error

    public function searchUser()
    {
        $this->user = User::where('status', 'activo')->where('cedula', $this->searchQuery)
                            ->orWhere('name', $this->searchQuery)->first();

        $this->errorMessage = '';
        if (!$this->user) {
            $this->errorMessage = 'Usuario no encontrado.';
        }
    }
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.verificar-equipo');
    }
}
