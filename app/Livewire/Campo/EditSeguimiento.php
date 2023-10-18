<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use App\Models\Seguimiento;
use App\Models\Worker;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditSeguimiento extends Component
{
    public Seguimiento $seguimiento;

    #[Rule('required')]
    public $fecha_seguimiento;
    #[Rule('required')]
    public $observacion;
    #[Rule('required')]
    public $tipo;
    #[Rule('required')]
    public $certificado_id;
    public $usuario;
    public $datos_encuestador;
    //buscador
    public $search = '';
    public $selectedCertificado = null;
    public $limit = 5;
    public $tipoSeleccionado;
    
    public $open = false;

    public function updatedSearch($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function mount()
    {
        $this->usuario = auth()->user();

        $this->fill(
            $this->seguimiento->only('planning_id', 'fecha_seguimiento', 'user_id', 'observacion', 'certificado_id', 'sticker_id', 'tipo'),
        );

        if ($this->tipo) {
            $this->tipoSeleccionado = true;
        }

        if ($this->certificado_id) {
            $this->selectedCertificado = Certificado::find($this->certificado_id);
        }

        $this->datos_encuestador = Worker::where('certificado_id', $this->certificado_id)->first();
    }

    public function seleccionarCertificado($certificadoId)
    {
        $this->selectedCertificado = Certificado::find($certificadoId);
        $this->datos_encuestador = Worker::where('certificado_id', $this->selectedCertificado->id)->first();
        $this->search = '';
    }

    public function updatedTipo($value)
    {
        if ($value) {
            $this->tipoSeleccionado = true;
        }
    }

    public function save()
    {
        $this->validate([
            'tipo' => 'required',
            'observacion' => 'required',
            'selectedCertificado' => 'required|unique:seguimientos,certificado_id,'.$this->seguimiento->id,
        ]);
        $this->seguimiento->update([
            'tipo' => $this->tipo,
            'fecha_seguimiento' => $this->datos_encuestador->fecha_encuesta,
            'observacion' => $this->observacion,
            'user_id' => $this->usuario->id,
            'planning_id' => $this->datos_encuestador->planning->id,
            'certificado_id' => $this->selectedCertificado->id,
        ]);

        $this->dispatch('saved');

        return redirect()->route('campo.coberturas.index');
    }

    #[Layout('layouts.campo')]
    public function render()
    {
        $certificados = [];
        if ($this->tipoSeleccionado) {
            $certificados = Certificado::where('equipment_id', $this->usuario->equipment_id)
                ->where('status', 'Ocupado')
                ->where('code', 'LIKE', '%' . $this->search . '%')
                ->limit($this->limit)
                ->get();
        }

        return view('livewire.campo.edit-seguimiento', ['certificados' => $certificados]);
    }
}
