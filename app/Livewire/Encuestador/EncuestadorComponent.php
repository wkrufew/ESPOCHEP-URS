<?php

namespace App\Livewire\Encuestador;

use App\Models\Worker;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class EncuestadorComponent extends Component
{
    use WithPagination;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.encuestador')]
    public function render()
    {
        if ($this->search) {
            $coberturas = Worker::query()
            ->where('user_id', auth()->user()->id)
            ->whereDate('fecha_encuesta', $this->search)
            ->orWhereHas('certificado', function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('sticker', function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);
        } else {
            $coberturas = Worker::where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
        }


        return view('livewire.encuestador.encuestador-component', compact('coberturas'));
    }
}
