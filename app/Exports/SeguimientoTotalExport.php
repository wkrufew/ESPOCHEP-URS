<?php

namespace App\Exports;

use App\Models\Seguimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeguimientoTotalExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $phase;

    public function __construct($phase)
    {
        $this->phase = $phase;
    }

    public function collection()
    {
        $reporte = Seguimiento::select(
            'plannings.provincia',
            'plannings.canton',
            'plannings.parroquia',
            'plannings.dpa',
            'plannings.areacensal',
            'plannings.codigo_manzana',
            DB::raw('MIN(seguimientos.fecha_seguimiento) as fecha_inicial'),
            DB::raw('MAX(seguimientos.fecha_seguimiento) as fecha_final'),
            DB::raw('COUNT(CASE WHEN seguimientos.tipo = "Seguimiento" THEN 1 END) as tipo_seguimiento'),
            DB::raw('COUNT(CASE WHEN seguimientos.tipo = "Supervision" THEN 1 END) as tipo_supervision')
        )
            ->leftJoin('plannings', 'seguimientos.planning_id', '=', 'plannings.id')
            /* ->groupBy('plannings.codigo_manzana') */
            ->where('plannings.phase_id', '=', $this->phase->id)
            ->groupBy('plannings.provincia', 'plannings.canton', 'plannings.parroquia', 'plannings.dpa', 'plannings.areacensal', 'plannings.codigo_manzana')
            ->orderBy('plannings.codigo_manzana')
            ->get();

        return $reporte;
    }

    public function headings(): array
    {
        return [
            'Provincia',
            'Canton',
            'Parroquia',
            'DPA',
            'Area Censal',
            'Codigo Manzana',
            'Fecha Inicial',
            'Fecha Final',
            'Total Seguimiento',
            'Total Supervision',
        ];
    }
}
