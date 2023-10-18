<?php

namespace App\Livewire\Gerencia;

use App\Models\Phase;
use App\Models\Planning;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CoberturasSectores extends Component
{
    use WithPagination;
    
    public $search = '';
    public $fase = '';
    public $fases = [];
    public $resultFase = '';
    public $perPage = 20;

    public function mount()
    {
        $this->fases = Phase::all();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFase($value)
    {
        $this->resultFase = Phase::find($value);
        $this->resetPage();
    }
    
    #[Layout('layouts.gerencia')]
    public function render()
    {
        $plannings = Planning::where('id', $this->resultFase)
            ->where('code', 'like', "%{$this->search}%")
            ->orWhere('provincia', 'like', "%{$this->search}%")
            ->orWhere('canton', 'like', "%{$this->search}%")
            ->orWhere('parroquia', 'like', "%{$this->search}%")
            ->orWhere('codigo_manzana', 'like', "%{$this->search}%")
            ->orWhereHas('equipment', function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->paginate($this->perPage);

            //dd($plannings);
        return view('livewire.gerencia.coberturas-sectores', [
            'plannings' => $plannings,
        ]);
    }
}
