<?php

namespace App\Livewire\Socializador;

use App\Models\Socializacion;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SocializadorComponent extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $socializaciones = Socializacion::where('codigo_manzana', 'like', '%' . $this->search . '%')
                                ->paginate(10);

        return view('livewire.socializador.socializador-component', compact('socializaciones'))->layout('layouts.socializador');
    }
}
