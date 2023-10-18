<?php

namespace App\Livewire\Admin;

use App\Models\Certificado;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CertificadoEstado extends Component
{
    public $inicio;
    public $fin;
    public $nuevoEstado = 'Disponible';
    public $estados = ['Disponible', 'Danado', 'Anulado'];

    protected $rules = [
        'inicio' => 'required|integer|digits:7|min:1',
        'fin' => 'required|integer|digits:7|min:1|gte:inicio',
    ];

    public function mount()
    {
        $this->rules = [
            'nuevoEstado' => 'required|in:' . implode(',', $this->estados),
        ];
    }

    public function cambiarEstado()
    {
        $this->validate();

        $certificadosExistentes = Certificado::whereBetween('code', [$this->inicio, $this->fin])->exists();

        if (!$certificadosExistentes) {
            session()->flash('message', 'Los certificados en el rango especificado no existen.');
            return;
        }

        $certificadosMismoEstado = Certificado::whereBetween('code', [$this->inicio, $this->fin])
            ->where('status', '=', $this->nuevoEstado)
            ->exists();

        if ($certificadosMismoEstado) {
            session()->flash('message', 'El estado de los certificados ya es el mismo que el nuevo estado.');
            return;
        }

        Certificado::whereBetween('code', [$this->inicio, $this->fin])->update(['status' => $this->nuevoEstado]);

        session()->flash('message', 'Estado de los certificados actualizado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.certificado-estado');
    }
}
