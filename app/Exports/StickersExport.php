<?php

namespace App\Exports;

use App\Models\Sticker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StickersExport implements FromCollection, ShouldAutoSize, WithHeadings
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
                'Codigo Sticker' => $item->code,
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
            'Codigo Sticker',
            'Estado',
            'Equipo',
            'Supervisor',
            'Encuestador',
            'Fecha de Creación',
        ];
    }
}
