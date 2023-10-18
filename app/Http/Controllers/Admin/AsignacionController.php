<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AsignacionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AsignacionController extends Controller
{
    public function export(Request $request)
    {
        $phase = $request->input('phase');
        //dd($phase);
        $encuestas = DB::table('workers')
            ->select(
                'plannings.code as planificacion',
                'plannings.provincia as provincia',
                'plannings.canton as canton',
                'plannings.parroquia as parroquia',
                'plannings.codigo_manzana as codigo_manzana',
                'plannings.dpa as DPA',
                'plannings.tipo_sector as tipo_sector',
                'plannings.hogares_planificados as hogares_planificados',
                'plannings.areacensal as areacensal',
                'plannings.status as status',
                DB::raw('SUM(efectivas) as total_efectivas'),
                DB::raw('SUM(rechazo) as total_rechazo'),
                DB::raw('SUM(nadie_en_casa) as total_nadie_en_casa'),
                DB::raw('SUM(informante_no_calificado) as total_informante_no_calificado'),
                DB::raw('SUM(temporal) as total_temporales'),
                DB::raw('SUM(desocupada) as total_desocupadas'),
                DB::raw('SUM(destruida) as total_destruidas'),
                DB::raw('SUM(construccion) as total_construccion'),
                'equipments.name as equipo',                'phases.name as fase',
                DB::raw('MIN(workers.fecha_encuesta) as fecha_inicial'),
                DB::raw('MAX(workers.fecha_encuesta) as fecha_final')
            )
            ->leftJoin('plannings', 'workers.planning_id', '=', 'plannings.id')
            ->leftJoin('phases', 'plannings.phase_id', '=', 'phases.id')
            ->leftJoin('equipments', 'plannings.equipment_id', '=', 'equipments.id')
            ->where('phases.id', '=', $phase)
            ->groupBy(
                'plannings.code',
                'equipments.name',
                'phases.name',
                'plannings.provincia',
                'plannings.canton',
                'plannings.parroquia',
                'plannings.codigo_manzana',
                'plannings.dpa',
                'plannings.areacensal',
                'plannings.tipo_sector',
                'plannings.hogares_planificados',
                'plannings.status',
            )
            ->get();

        return Excel::download(new AsignacionExport($encuestas), 'Matriz-Cobertura-Total.xlsx');
    }
}
