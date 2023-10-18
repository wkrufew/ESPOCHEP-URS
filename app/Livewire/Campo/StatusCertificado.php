<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StatusCertificado extends Component
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

        // Verifica si todos los certificados en el rango existen
        $certificadosExistentes = Certificado::whereBetween('code', [$this->inicio, $this->fin])->exists();

        if (!$certificadosExistentes) {
            session()->flash('message', 'Los certificados en el rango especificado no existen.');
            return;
        }

        $certificadosAsignados = Certificado::whereBetween('code', [$this->inicio, $this->fin])
            ->where('equipment_id', '<>' ,auth()->user()->equipment_id)
            ->exists();

        if ($certificadosAsignados) {
            session()->flash('message', 'Algunos certificados en el rango ya están asignados a otro equipo.');
            return;
        }

        $certificadosMismoEstado = Certificado::whereBetween('code', [$this->inicio, $this->fin])
            ->where('status', '=', $this->nuevoEstado)
            ->exists();

        if ($certificadosMismoEstado) {
            session()->flash('message', 'El estado de los certificados es el mismo que el actual elija un estado diferente.');
            return;
        }

        // Actualiza el estado de los certificados en el rango
        Certificado::whereBetween('code', [$this->inicio, $this->fin])->update(['status' => $this->nuevoEstado]);

        session()->flash('message', 'Estado de los certificados actualizado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
    }

    #[Layout('layouts.campo')]
    public function render()
    {
        return view('livewire.campo.status-certificado');
    }
}
