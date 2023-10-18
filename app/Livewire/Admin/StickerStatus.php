<?php

namespace App\Livewire\Admin;

use App\Models\Sticker;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StickerStatus extends Component
{
    public $inicio;
    public $fin;
    public $nuevoEstado = 'Disponible';
    public $estados = ['Disponible', 'Danado', 'Anulado', 'Extraviado'];

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

        $stickersExistentes = Sticker::whereBetween('code', [$this->inicio, $this->fin])->exists();

        if (!$stickersExistentes) {
            session()->flash('message', 'Los stickers en el rango especificado no existen.');
            return;
        }

        $stickersMismoEstado = Sticker::whereBetween('code', [$this->inicio, $this->fin])
            ->where('status', '=', $this->nuevoEstado)
            ->exists();

        if ($stickersMismoEstado) {
            session()->flash('message', 'El estado de los stickers ya es el mismo que el nuevo estado.');
            return;
        }

        Sticker::whereBetween('code', [$this->inicio, $this->fin])->update(['status' => $this->nuevoEstado]);

        session()->flash('message', 'Estado de los stickers actualizado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sticker-status');
    }
}
