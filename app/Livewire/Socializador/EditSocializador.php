<?php

namespace App\Livewire\Socializador;

use App\Models\Socializacion;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditSocializador extends Component
{
    public Socializacion $socializacion;

    public $fase;
    #[Rule('required')]
    public $provincia;
    #[Rule('required')]
    public $canton;
    #[Rule('required')]
    public $parroquia;
    #[Rule('required')]
    public $codigo_manzana;
    #[Rule('required')]
    public $hogares_p;
    #[Rule('required')]
    public $hogares_i;
    #[Rule('required')]
    public $observacion;
    #[Rule('required')]
    public $dipticos;
    #[Rule('required')]
    public $status;

    public $usuario;

    public function mount(){

        $this->usuario = auth()->user();

        $this->fill(
            $this->socializacion->only('fase', 'provincia', 'canton', 'parroquia', 'codigo_manzana', 'hogares_p', 'hogares_i', 'observacion', 'dipticos', 'status'/* , 'user_id' */),
        );
    }

    public function updateSocializador()
    {
        $this->socializacion->update([
            'fase' => $this->fase,
            'provincia' => $this->provincia,
            'observacion' => $this->observacion,
            'canton' => $this->canton,
            'parroquia' => $this->parroquia,
            'observacion' => $this->observacion,
            'codigo_manzana' => $this->codigo_manzana,
            'hogares_p' => $this->hogares_p,
            'hogares_i' => $this->hogares_i,
            'dipticos' => $this->dipticos,
            'status' => $this->status,
            'user_id' => $this->usuario->id,
        ]);

        $this->dispatch('saved');
    }

    #[Layout('layouts.socializador')]
    public function render()
    {
        return view('livewire.socializador.edit-socializador');
    }
}
