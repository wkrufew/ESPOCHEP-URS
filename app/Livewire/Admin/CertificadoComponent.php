<?php

namespace App\Livewire\Admin;

use App\Models\Certificado;
use App\Models\Equipment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CertificadoComponent extends Component
{
    public $inicio;
    public $fin;
    public $search = '';
    public $selectedEquipo = null;
    public $limit = 5;
    public $equipos;

    public $open = false;

    public function updatedSearch($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
    }

    public function seleccionarEquipo($equipmentId)
    {
        $this->selectedEquipo = Equipment::find($equipmentId);
        $this->search = '';
        $this->equipos = [];
    }

    public function save()
    {
        $this->validate([
            'inicio' => 'required|integer|digits:7',
            'fin' => 'required|integer|digits:7|gte:inicio',
        ]);

        if ($this->selectedEquipo == NULL) {
            session()->flash('messageType', 'error');
            session()->flash('message', 'Seleccione un equipo.');
            return;
        }

        $equipo = Equipment::where('name', $this->selectedEquipo->name)->first();

        if (!$equipo) {
            session()->flash('messageType', 'error');
            session()->flash('message', 'El equipo ' . $this->selectedEquipo->name . ' no existe en la base de datos.');
            return;
        }

        $existingCodes = [];

        $existingCertificates = Certificado::where('equipment_id', '<>', $equipo->id)
            ->whereIn('code', range($this->inicio, $this->fin))
            ->get();

        if ($existingCertificates->isNotEmpty()) {
            session()->flash('messageType', 'error');
            session()->flash('message', 'Los certificados en el rango ingresado ya han sido asignados a otro equipo.');
            return;
        }

        $existingCertificatesD = Certificado::whereIn('code', range($this->inicio, $this->fin))->get();

        if ($existingCertificatesD->isNotEmpty()) {
            session()->flash('messageType', 'error');
            session()->flash('message', 'Algunos de los certificados en el rango ingresado ya existen en la base de datos.');
            return;
        }

        for ($i = $this->inicio; $i <= $this->fin; $i++) {
            $newCode = (string) $i;

            if (in_array($newCode, $existingCodes)) {
                session()->flash('messageType', 'error');
                session()->flash('message', 'El código' .$newCode. ' ya existe en la base de datos.');
                return;
            }

            $existingCodes[] = $newCode;

            Certificado::create([
                'code' => $newCode,
                'equipment_id' => $equipo->id,
            ]);
        }

        session()->flash('messageType', 'success');;
        session()->flash('message', 'Rango de certificados creado exitosamente.');

        $this->inicio = null;
        $this->fin = null;
        $this->selectedEquipo = null;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $equipments = Equipment::where('name', 'LIKE', '%' . $this->search . '%')
            ->limit($this->limit)
            ->get();

        return view('livewire.admin.certificado-component', ['equipments' => $equipments]);
    }
}
