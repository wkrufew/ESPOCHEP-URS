<?php

namespace App\Imports;

use App\Models\Equipment;
use App\Models\Phase;
use App\Models\Planning;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class PlanningsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation
{
    private $phases;
    private $equipments;

    public function __construct()
    {
        $this->phases = Phase::pluck('id', 'name');
        $this->equipments = Equipment::pluck('id', 'name');
    }
    
    public function model(array $row)
    {
        $existingPlanning = DB::table('plannings')->where('code', $row['code'])->first();

        // Si el código ya existe, omite la creación del registro
        if ($existingPlanning) {
            return null; // Retorna null para omitir el registro
        }
        
        return new Planning([
            'code'  => $row['code'],
            'provincia' => $row['provincia'],
            'canton' => $row['canton'],
            'parroquia' => $row['parroquia'],
            'dpa' => $row['dpa'],
            'areacensal' => $row['areacensal'],
            'codigo_manzana' => $row['codigo_manzana'],
            'tipo_sector' => $row['tipo_sector'],
            'hogares_planificados' => $row['hogares_planificados'],
            'fecha_inicio' => $row['fecha_inicio'],
            'fecha_fin' => $row['fecha_fin'],
            'dias' => $row['dias'],
            'phase_id' => $this->phases[$row['fase']],
            'equipment_id' => $this->equipments[$row['equipo']],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.tipo_sector' => [/* 'integer', */ 'required'],
            '*.dias' => [/* 'integer', */ 'required'],
            '*.fecha_inicio' => ['date', 'required'],
            '*.fecha_fin' => ['date', 'required'],
            '*.hogares_planificados' => [/* 'integer', */ 'required'],
            '*.fase' => ['required'],
            /* '*.equipment_id' => ['integer', 'required'], */
        ];
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
