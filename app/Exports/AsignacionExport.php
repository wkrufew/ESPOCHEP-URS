<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsignacionExport implements FromCollection, ShouldAutoSize, WithHeadings
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
                'Planificacion' => $item->planificacion,
                'Equipo' => $item->equipo,
                'Provincia' => $item->provincia,
                'Canton' => $item->canton,
                'Parroquia' => $item->parroquia,
                'DPA' => $item->DPA,
                'Codigo Censal' => $item->areacensal,
                'Codigo Manzana' => $item->codigo_manzana,
                'Tipo Sector' => $item->tipo_sector,
                'Hogares Planificados' => $item->hogares_planificados,
                'Fase' => $item->fase,
                'Fecha Inicial' => $item->fecha_inicial,
                'Fecha Final' => $item->fecha_final,
                'Total Efectivas' => $item->total_efectivas,
                'Total Rechazo' => $item->total_rechazo,
                'Total Nadie en Casa' => $item->total_nadie_en_casa,
                'Total Informante no Calificado' => $item->total_informante_no_calificado,
                'Total Temporales' => $item->total_temporales,
                'Total Desocupadas' => $item->total_desocupadas,
                'Total Destruidas' => $item->total_destruidas,
                'Total Construcción' => $item->total_construccion,
                'Estado' => $item->status,
            ];
        });
    }

    public function headings(): array
    {
        // Define las cabeceras de las columnas aquí
        return [
            'Planificacion',
            'Equipo',
            'Provincia',
            'Canton',
            'Parroquia',
            'DPA',
            'Codigo Censal',
            'Codigo Manzana',
            'Tipo Sector', 
            'Hogares Planificados',
            'Fase',
            'Fecha Inicial',
            'Fecha Final',
            'Total Efectivas',
            'Total Rechazo',
            'Total Nadie en Casa',
            'Total Informante no Calificado',
            'Total Temporales',
            'Total Desocupadas',
            'Total Destruidas',
            'Total Construcción',
            'Estado',
        ];
    }
}
