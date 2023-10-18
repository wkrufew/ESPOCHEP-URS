<?php

namespace App\Exports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsolidadoCoberturasCampoExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, ShouldAutoSize, WithHeadings, WithCustomValueBinder
{
    protected $phase;

    public function __construct($phase)
    {
        $this->phase = $phase;
    }

    public function collection()
    {
        return Worker::join('plannings', 'plannings.id', '=', 'workers.planning_id')
            ->join('phases', 'phases.id', '=', 'plannings.phase_id')
            ->join('equipments', 'equipments.id', '=', 'plannings.equipment_id')
            ->leftJoin('users', 'users.id', '=', 'workers.user_id')
            ->leftJoin('certificados', 'certificados.id', '=', 'workers.certificado_id')
            ->leftJoin('stickers', 'stickers.id', '=', 'workers.sticker_id')
            ->where('equipments.id', auth()->user()->equipment->id)
            ->where('plannings.phase_id', $this->phase->id)
            ->select('phases.name as Fase', 'plannings.code as Código', 'equipments.name as Equipo', 'plannings.provincia as Provincia', 'plannings.canton as Cantón', 'plannings.parroquia as Parroquia', 'plannings.dpa as DPA', 'plannings.codigo_manzana as Código Manzana', 'plannings.tipo_sector as Tipo Sector', 'workers.fecha_encuesta as Fecha Encuesta', 'workers.dia as Día', 'workers.efectivas as Efectivas', 'workers.rechazo as Rechazo', 'workers.nadie_en_casa as Nadie en Casa', 'workers.informante_no_calificado as Informante No Calificado', 'workers.temporal as Temporal', 'workers.desocupada as Desocupada', 'workers.destruida as Destruida', 'workers.construccion as Construccion', 'users.name as Usuario', 'certificados.code as Certificado', 'stickers.code as Stickers', 'workers.observacion as Observación')
            ->orderBy('plannings.code', 'asc') // Ordena por código de planificación en orden ascendente
            ->orderBy('workers.fecha_encuesta', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fase',
            'Código Planifiacion',
            'Equipo',
            'Provincia',
            'Cantón',
            'Parroquia',
            'DPA',
            'Código Sector/Manzana',
            'Tipo Sector',
            'Fecha Encuesta',
            'Día',
            'Efectivas',
            'Rechazo',
            'Nadie en Casa',
            'Informante No Calificado',
            'Temporal',
            'Desocupada',
            'Destruida',
            'Construccion',
            'Usuario',
            'Certificado',
            'Sticker',
            'Observación',
        ];
    }
}

