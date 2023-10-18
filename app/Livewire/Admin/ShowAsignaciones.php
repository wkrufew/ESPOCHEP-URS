<?php

namespace App\Livewire\Admin;

use App\Models\Assignment;
use Livewire\Component;
use Livewire\WithPagination;

class ShowAsignaciones extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $asignaciones = Assignment::where('code', 'like', '%' . $this->search . '%')
                                        ->latest()->paginate(10);
        return view('livewire.admin.show-asignaciones', compact('asignaciones'))->layout('layouts.admin');
    }
}
