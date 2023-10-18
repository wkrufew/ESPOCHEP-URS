<?php

namespace App\Livewire\Gerencia;

use App\Models\Equipment;
use App\Models\User;
use App\Models\Worker;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CoberturasEquipos extends Component
{
    public $equipmentNumber/* ='C4G03' */;
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
                ->selectRaw('SUM(workers.efectivas) as total_efectivas, SUM(workers.rechazo) as total_rechazo, SUM(workers.informante_no_calificado) as total_informante, SUM(workers.nadie_en_casa) as total_nadie_en_casa , SUM(workers.temporal) as total_temporal, SUM(workers.desocupada) as total_desocupada, SUM(workers.destruida) as total_destruida, SUM(workers.construccion) as total_construccion')
                ->get();

                //dd($this->teamMembers);
        } else {
            $this->teamMembers = [];
        }
    }


    #[Layout('layouts.gerencia')]
    public function render()
    {
        return view('livewire.gerencia.coberturas-equipos');
    }
}
