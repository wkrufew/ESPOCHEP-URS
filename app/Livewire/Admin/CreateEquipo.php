<?php

namespace App\Livewire\Admin;

use App\Models\Equipment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateEquipo extends Component
{
    public $inicio;
    public $fin;
    public $mensaje;

    public function save()
    {
        $this->validate([
            'inicio' => 'required|integer|min:1',
            'fin' => 'required|integer|min:' . $this->inicio,
        ], [
            'inicio.required' => 'El campo Inicio es obligatorio.',
            'inicio.integer' => 'El campo Inicio debe ser un número entero.',
            'inicio.min' => 'El valor de Inicio debe ser mayor o igual a 1.',
            'fin.required' => 'El campo Fin es obligatorio.',
            'fin.integer' => 'El campo Fin debe ser un número entero.',
            'fin.min' => 'El valor de Fin debe ser mayor o igual al valor de Inicio.',
        ]);

        if ($this->inicio <= $this->fin) {
            for ($i = $this->inicio; $i <= $this->fin; $i++) {
                $codigoEquipo = "C4G" . str_pad($i, 2, '0', STR_PAD_LEFT);

                // Verificar si el código del equipo ya existe en la base de datos
                $equipoExistente = Equipment::where('name', $codigoEquipo)->exists();

                if (!$equipoExistente) {
                    Equipment::create([
                        'name' => $codigoEquipo,
                        'status' => 1, // Puedes ajustar el estado según tus necesidades
                    ]);
                } else {
                    // Mostrar un mensaje de error si el código ya existe en la base de datos
                    $this->mensaje = "El código $codigoEquipo ya existe en la base de datos.";
                    return;
                }
            }

            $this->mensaje = 'Equipos generados exitosamente.';
            return redirect()->route('admin.equipos.index');
        } else {
            $this->mensaje = 'El valor de inicio debe ser menor o igual al valor de finalización.';
        }

        
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.create-equipo');
    }
}
