<?php

namespace App\Exports;

use App\Models\Seguimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SeguimientoCampoExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $phase;

    public function __construct($phase)
    {
        $this->phase = $phase;
    }

    public function collection()
    {
        return Seguimiento::select(
            'plannings.provincia',
            'plannings.canton',
            'plannings.parroquia',
            'plannings.dpa',
            'plannings.areacensal',
            'plannings.codigo_manzana',
            'phases.name as fase',
            'seguimientos.fecha_seguimiento',
            'users.name as nombre_usuario',
            'users.cedula as cedula_usuario',
            'certificados.code as certificado',
            'seguimientos.tipo'
        )
            ->leftJoin('plannings', 'seguimientos.planning_id', '=', 'plannings.id')
            ->leftJoin('phases', 'plannings.phase_id', '=', 'phases.id')
            ->leftJoin('users', 'seguimientos.user_id', '=', 'users.id')
            ->leftJoin('certificados', 'seguimientos.certificado_id', '=', 'certificados.id')
            ->where('plannings.phase_id', '=', $this->phase->id)
            ->where('seguimientos.user_id', '=', auth()->user()->id)
            ->orderBy('plannings.codigo_manzana', 'asc')
            ->orderBy('seguimientos.fecha_seguimiento', 'asc')
            ->orderBy('seguimientos.tipo', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Provincia',
            'Canton',
            'Parroquia',
            'DPA',
            'Areacensal',
            'Codigo Manzana',
            'Fase',
            'Fecha Supervision',
            'Nombre Usuario',
            'Cedula Usuario',
            'Certificado',
            'Tipo',
        ];
    }
}
