<?php

namespace App\Livewire\Provincial;

use App\Models\Equipment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CoberturaEquipos extends Component
{
    public $equipmentNumber;
    public $fecha;
    public $teamMembers;

    public function performSearch()
    {
        $this->validate([
            'equipmentNumber' => 'required',
            'fecha' => 'date|required',
        ]);

        $equipment = Equipment::where('name', $this->equipmentNumber)->first();
        
        if ($equipment) {
            $this->teamMembers = User::select('users.id', 'users.name', 'users.role', 'users.equipment_id')
                ->where('status', 'activo')
                ->where('equipment_id', $equipment->id)
                ->leftJoin('workers', function($join) {
                    $join->on('users.id', '=', 'workers.user_id')
                         ->whereDate('workers.fecha_encuesta', $this->fecha);
                })
                ->groupBy('users.id', 'users.name', 'users.role', 'users.equipment_id')
                ->selectRaw('SUM(workers.efectivas) as total_efectivas, SUM(workers.rechazo) as total_rechazo, SUM(workers.informante_no_calificado) as total_informante, SUM(workers.nadie_en_casa) as total_nadie_en_casa')
                ->get();
        } else {
            $this->teamMembers = [];
        }
    }


    #[Layout('layouts.provincial')]
    public function render()
    {
        return view('livewire.provincial.cobertura-equipos');
    }
}
