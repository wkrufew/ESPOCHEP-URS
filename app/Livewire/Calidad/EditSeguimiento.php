<?php

namespace App\Livewire\Calidad;

use Livewire\Attributes\Layout;
use Livewire\Component;

class EditSeguimiento extends Component
{
    #[Layout('layouts.calidad')]
    public function render()
    {
        return view('livewire.calidad.edit-seguimiento');
    }
}
