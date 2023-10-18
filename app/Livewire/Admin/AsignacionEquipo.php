<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AsignacionEquipo extends Component
{
    use WithPagination;

    public $search = '';
    public $user;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refresh')]
    #[Layout('layouts.admin')]
    public function render()
    {
        $usuarios = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('cedula', 'like', '%' . $this->search . '%')
                ->orWhere('role', 'like', '%' . $this->search . '%');
        })
            ->whereNotIn('role', ['admin'])
            ->paginate(10);
        return view('livewire.admin.asignacion-equipo', compact('usuarios'));
    }
}
