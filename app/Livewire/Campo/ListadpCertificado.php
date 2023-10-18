<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListadpCertificado extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedCertificado = null;
    public $certificadoInfo = null;

    public function updatingSearch(){
        $this->resetPage();
    }
    
    #[Layout('layouts.campo')]
    public function render()
    {
        $certificados = Certificado::whereIn('status',['Disponible','Anulado','Danado'])->where('equipment_id', auth()->user()->equipment_id)->where('code', 'LIKE', "%$this->search%")->paginate(10);

        return view('livewire.campo.listadp-certificado', compact('certificados'));
    }
}
