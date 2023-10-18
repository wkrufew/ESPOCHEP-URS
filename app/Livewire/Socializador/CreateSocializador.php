<?php

namespace App\Livewire\Socializador;

use App\Models\Planning;
use App\Models\Socializacion;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateSocializador extends Component
{
    public $fase, $provincia, $canton, $parroquia, $codigo_manzana, $hogares_p, $hogares_i, $dipticos, $observacion, $status;

    protected $rules = [
        'fase' => 'required',
        'provincia' => 'required',
        'canton' => 'required',
        'parroquia' => 'required',
        'codigo_manzana' => 'required',
        'hogares_p' => 'required',
        'hogares_i' => 'required',
        'dipticos' => 'required',
        'observacion' => 'required',
        'status' => 'required',
    ];

    public function save()
    {
        $this->validate($this->rules);

        $socializacion = new Socializacion([
            'user_id' => auth()->user()->id,
            'fase' => $this->fase,
            'provincia' => strtoupper($this->provincia),
            'canton' => strtoupper($this->canton),
            'parroquia' => strtoupper($this->parroquia),
            'codigo_manzana' => $this->codigo_manzana,
            'hogares_p' => $this->hogares_p,
            'hogares_i' => $this->hogares_i,
            'dipticos' => $this->dipticos,
            'status' => $this->status,
            'observacion' => $this->observacion,
        ]);

        $socializacion->save();

        $this->reset(['fase', 'provincia', 'canton', 'parroquia', 'codigo_manzana', 'hogares_p', 'hogares_i', 'dipticos', 'status', 'observacion']);

        return redirect()->route('socializador.index');
    }

    #[Layout('layouts.socializador')]
    public function render()
    {
        return view('livewire.socializador.create-socializador');
    }
}
