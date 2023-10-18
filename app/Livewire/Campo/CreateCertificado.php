<?php

namespace App\Livewire\Campo;

use App\Models\Certificado;
use App\Models\Equipment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateCertificado extends Component
{
    public $inicio;
    public $fin;
    public $nombreEquipo; // Nueva propiedad para almacenar el nombre del equipo

    public function mount()
    {
        $this->nombreEquipo = auth()->user();
    }

    public function save()
    {
        if (/* empty($this->nombreEquipo) || */empty($this->inicio) || empty($this->fin) || $this->inicio == 0 || $this->fin == 0 || strlen($this->inicio) !== 7 || strlen($this->fin) !== 7 || !is_numeric($this->inicio) || !is_numeric($this->fin)) {
            session()->flash('message', 'Por favor, complete los campos con valores válidos.');
            return;
        }

        // Validar si los certificados ya están asignados a otro equipo
        $existingCodes = []; // Inicializar el arreglo

        $existingCertificates = Certificado::where('equipment_id', '<>', $this->nombreEquipo->equipment->id)
            ->whereIn('code', range($this->inicio, $this->fin))
            ->get();

        if ($existingCertificates->isNotEmpty()) {
            /* $codes = $existingCertificates->pluck('code')->implode(', '); */
            session()->flash('message', "Los certificados en el rango ingresado ya han sido asignados a otro equipo.");  //[$codes] imprime los codigos que estan ya en otro equipo
            return;
        }

        $existingCertificatesD = Certificado::whereIn('code', range($this->inicio, $this->fin))->get();

        if ($existingCertificatesD->isNotEmpty()) {
            session()->flash('message', "Algunos de los certificados en el rango ingresado ya existen en la base de datos.");
            return;
        }

        for ($i = $this->inicio; $i <= $this->fin; $i++) {
            $newCode = (string) $i;

            if (in_array($newCode, $existingCodes)) {
                session()->flash('message', "El código $newCode ya existe en la base de datos.");
                return;
            }

            $existingCodes[] = $newCode;

            Certificado::create([
                'code' => $newCode,
                'equipment_id' => $this->nombreEquipo->equipment->id,
            ]);
        }

        session()->flash('message', 'Rango de certificados creado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
    }

    #[Layout('layouts.campo')]
    public function render()
    {
        return view('livewire.campo.create-certificado');
    }
}
