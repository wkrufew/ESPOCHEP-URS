<?php

namespace App\Livewire\Admin;

use App\Models\Certificado;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class CertificadoShow extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedCertificado = null;
    public $certificadoInfo = null;

    public function updatingSearch(){
        $this->resetPage();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $certificados = Certificado::where('code', 'LIKE', "%$this->search%")->paginate(10);

        return view('livewire.admin.certificado-show', compact('certificados'));
    }
}
