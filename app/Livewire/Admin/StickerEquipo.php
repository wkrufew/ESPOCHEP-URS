<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use App\Models\Sticker;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StickerEquipo extends Component
{public $inicio;
    public $fin;
    public $search1 = '';
    public $search2 = '';
    public $selectedEquipo1 = null;
    public $selectedEquipo2 = null;
    public $limit = 5;
    public $open1 = false;
    public $open2 = false;

    protected $rules = [
        'inicio' => 'required|integer|digits:7',
        'fin' => 'required|integer|digits:7|gte:inicio',
        'selectedEquipo1' => 'required',
        'selectedEquipo2' => 'required',
    ];

    protected $messages = [
        'inicio.required' => 'El campo Inicio es requerido.',
        'inicio.integer' => 'El campo Inicio debe ser un número entero.',
        'inicio.digits' => 'El campo Inicio debe tener exactamente 7 dígitos.',
        'fin.required' => 'El campo Fin es requerido.',
        'fin.integer' => 'El campo Fin debe ser un número entero.',
        'fin.digits' => 'El campo Fin debe tener exactamente 7 dígitos.',
        'fin.gte' => 'El campo Fin no debe ser menor que el campo inicio.',
        'selectedEquipo1.required' => 'El campo Equipo Actual es requerido.',
        'selectedEquipo2.required' => 'El campo Nuevo Equipo es requerido.',
    ];

    public function updatedSearch1($value)
    {
        if ($value) {
            $this->open1 = true;
        } else {
            $this->open1 = false;
        }
    }
    public function updatedSearch2($value)
    {
        if ($value) {
            $this->open2 = true;
        } else {
            $this->open2 = false;
        }
    }

    public function seleccionarEquipo1($equipmentId)
    {
        $this->selectedEquipo1 = Equipment::find($equipmentId);
        $this->search1 = '';
    }
    public function seleccionarEquipo2($equipmentId)
    {
        $this->selectedEquipo2 = Equipment::find($equipmentId);
        $this->search2 = '';
    }

    public function cambiarAsignacion()
    {
        $this->validate();

        $stickersExistentes = Sticker::whereBetween('code', [$this->inicio, $this->fin])->exists();

        if (!$stickersExistentes) {
            $this->setFlashMessage('error', 'Los stickers en el rango especificado no existen.');
            return;
        }

        $equipoActual = Equipment::where('name', $this->selectedEquipo1->name)->first();
        $nuevoEquipo = Equipment::where('name', $this->selectedEquipo2->name)->first();

        if ($equipoActual == $nuevoEquipo) {
            $this->setFlashMessage('error', 'Ingrese equipos diferentes');
            return;
        }

        if (!$equipoActual || !$nuevoEquipo) {
            $this->setFlashMessage('error', 'Uno o ambos equipos no existen en la base de datos.');
            return;
        }

        $stickersAsignados = Sticker::whereBetween('code', [$this->inicio, $this->fin])
            ->where('equipment_id', $nuevoEquipo->id)
            ->exists();

        if ($stickersAsignados) {
            $this->setFlashMessage('error', 'Algunos stickers en el rango ya están asignados al nuevo equipo.');
            return;
        }

        $inicio = (int) $this->inicio;
        $fin = (int) $this->fin;

        Sticker::whereBetween('code', [$inicio, $fin])
            ->where('equipment_id', $equipoActual->id)
            ->update(['equipment_id' => $nuevoEquipo->id]);

        $this->setFlashMessage('success', 'Asignación de stickers actualizada exitosamente.');

        $this->resetFields();
    }

    private function setFlashMessage($type, $message)
    {
        session()->flash('messageType', $type);
        session()->flash('message', $message);
    }

    private function resetFields()
    {
        $this->inicio = null;
        $this->fin = null;
        $this->selectedEquipo1 = null;
        $this->selectedEquipo2 = null;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $equipments1 = [];
        $equipments2 = [];

        if ($this->search1) {
            $equipments1 = Equipment::where('name', 'LIKE', '%' . $this->search1 . '%')
                ->limit($this->limit)
                ->get();
        } elseif ($this->search2) {
            $equipments2 = Equipment::where('name', 'LIKE', '%' . $this->search2 . '%')
                ->limit($this->limit)
                ->get();
        }

        return view('livewire.admin.sticker-equipo', ['equipments1' => $equipments1, 'equipments2' => $equipments2]);
    }
}
