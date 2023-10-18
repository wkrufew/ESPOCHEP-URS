<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use App\Models\Seguimiento;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CampoComponent extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.campo')]
    public function render()
    {
        if ($this->search) {
            /* $fechaBuscada = $this->search; // El formato es "YYYY-MM-DD"
            $seguimientos = Seguimiento::where('user_id', auth()->user()->id)
                ->whereDate('fecha_seguimiento', $fechaBuscada)
                ->paginate(10); */
            $seguimientos = Seguimiento::query()
                ->where('user_id', auth()->user()->id)
                ->whereDate('fecha_seguimiento', $this->search)
                ->orWhereHas('certificado', function ($query) {
                    $query->where('code', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
        } else {
            $seguimientos = Seguimiento::where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
        }
        return view('livewire.campo.campo-component', compact('seguimientos'));
    }
}
/* puchismay@gmail.com
1719269506 */
/* 
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
 */