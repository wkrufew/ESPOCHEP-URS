<?php

namespace App\Livewire;

use App\Models\Socializacion;
use Livewire\Attributes\Layout;
use Livewire\Component;

class NovedadesComponent extends Component
{
    public $search = '';
    public $resultados = []; 
    public $visible = false;
    public $mensaje = '';
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.novedades-component');
    }

    public function consultar()
    {
        $query = Socializacion::where('codigo_manzana', $this->search);

        $this->resultados = $query->get();

        if (count($this->resultados)) {
            $this->visible = true;
            $this->mensaje = '';
        } else {
            $this->visible = false;
            $this->mensaje = 'Sin resultados pruebe con otro codigo';
        }
    }
}
