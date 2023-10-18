<?php

namespace App\Livewire\Calidad;

use App\Models\Seguimiento;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListarSeguimientos extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch(){
        $this->resetPage();
    }

    #[Layout('layouts.calidad')]
    public function render()
    {
        if ($this->search) {
            $fechaBuscada = $this->search;
            $seguimientos = Seguimiento::where('user_id', auth()->user()->id)
                ->whereDate('fecha_seguimiento', $fechaBuscada)
                ->paginate(10);
        } else {
            $seguimientos = Seguimiento::where('user_id', auth()->user()->id)
                ->paginate(10);
        }
        
        return view('livewire.calidad.listar-seguimientos', compact('seguimientos'));
    }
}
