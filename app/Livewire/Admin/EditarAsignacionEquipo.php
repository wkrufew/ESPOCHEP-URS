<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditarAsignacionEquipo extends Component
{
    public User $user;

    #[Rule('nullable')]
    public $phone;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $email;

    #[Rule('nullable')]
    public $cedula;

    #[Rule('nullable')]
    public $equipment_id;

    #[Rule('required')]
    public $status;

    #[Rule('required')]
    public $role;

    public $newPassword = null;

    public $equipos = [];


    public function mount()
    {
        $this->equipos = Equipment::all();

        $this->fill(
            $this->user->only('status', 'name', 'email', 'phone', 'cedula', 'equipment_id', 'role', 'password'),
        );
    }

    public function save()
    {
        /* $rules = [
            'password' => 'required',
        ]; */

        // Agrega reglas de validación para el campo 'password' solo si se proporciona una nueva contraseña.
        if (!empty($this->newPassword)) {
            $rules['newPassword'] = 'min:8';
        }

        $this->validate();


        $data = [
            'status' => $this->status,
            'phone' => $this->phone ? $this->phone : NULL,
            'cedula' => $this->cedula ? $this->cedula : NULL,
            'email' => $this->email,
            'name' => $this->name,
            'role' => $this->role,
            'equipment_id' => $this->equipment_id ? $this->equipment_id : NULL,
        ];

        if (!empty($this->newPassword)) {
            $data['password'] = bcrypt($this->newPassword);
        }


        $this->user->update($data);

        $this->dispatch('saved');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.editar-asignacion-equipo');
    }
}
