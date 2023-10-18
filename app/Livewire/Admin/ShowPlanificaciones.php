<?php

namespace App\Livewire\Admin;

use App\Models\Planning;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPlanificaciones extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $planificaciones = Planning::query()
            ->where('code', 'like', '%' . $this->search . '%')
            ->orWhere('provincia', 'like', '%' . $this->search . '%')
            ->orWhere('canton', 'like', '%' . $this->search . '%')
            ->orWhere('parroquia', 'like', '%' . $this->search . '%')
            ->orWhere('codigo_manzana', 'like', '%' . $this->search . '%')
            ->orWhere('dpa', 'like', '%' . $this->search . '%')
            ->orWhere('areacensal', 'like', '%' . $this->search . '%')
            ->orWhereHas('equipment', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.show-planificaciones', compact('planificaciones'))->layout('layouts.admin');
    }
}
