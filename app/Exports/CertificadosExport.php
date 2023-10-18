<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CertificadosExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'ID' => $item->id,
                'Código Certificado' => $item->code,
                'Estado' => $item->status,
                'Equipo' => $item->equipment->name,
                'Supervisor' => optional($item->equipment->campoUser)->name,
                'Encuestador' => optional($item->user)->name,
                'Fecha de Creación' => $item->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Código Certificado',
            'Estado',
            'Equipo',
            'Supervisor',
            'Encuestador',
            'Fecha de Creación',
        ];
    }
}
