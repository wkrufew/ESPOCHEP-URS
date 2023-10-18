<?php

namespace App\Livewire\Admin;

use App\Models\Planning;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PlanificacionStatus extends Component
{
    public $inicio;
    public $fin;
    public $nuevoEstado;
    public $estados = [0, 1, 2];

    protected $rules = [
        'inicio' => 'required|string|min:5',
        'fin' => 'required|string|min:5',
        'nuevoEstado' => 'required|in:0,1,2',
    ];

    public function cambiarEstado()
    {
        $this->validate();

        $planificacionesExistentes = Planning::whereBetween('code', [$this->inicio, $this->fin])->exists();

        if (!$planificacionesExistentes) {
            $this->setFlashMessage('error', 'Las planificaciones en el rango especificado no existen.');
            return;
        }
        
        Planning::whereBetween('code', [$this->inicio, $this->fin])->update(['status' => $this->nuevoEstado]);
        $this->setFlashMessage('success', 'Estado de las planificaciones actualizado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
    }

    private function setFlashMessage($type, $message)
    {
        session()->flash('messageType', $type);
        session()->flash('message', $message);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.planificacion-status');
    }
}
