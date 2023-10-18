<?php

namespace App\Imports;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation

{
    private $equipments;

    public function __construct()
    {
        $this->equipments = Equipment::pluck('id', 'name');
    }

    public function model(array $row)
    {
        if (!isset($row['email']) || empty($row['email'])) {
            return null; // Retorna null para omitir el registro
        }
        
        $existingUsers = DB::table('users')->where('email', $row['email'])->first();

        // Si el código ya existe, omite la creación del registro
        if ($existingUsers) {
            return null; // Retorna null para omitir el registro
        }

        $userData = [
            'name'  => $row['nombres'],
            'email' => $row['email'],
            'phone' => $row['telefono'],
            'cedula' => $row['cedula'],
            'status' => $row['estado'],
            'role' => $row['rol'],
            'password' => bcrypt($row['password']),
        ];

        // Verifica si el campo 'equipo' existe en la fila y si hay un equipo asociado.
        if (isset($row['equipo']) && !empty($row['equipo'])) {
            $equipmentId = $this->equipments[$row['equipo']];
            $userData['equipment_id'] = $equipmentId ? $equipmentId : null;
        } else {
            // Si el campo 'equipo' está ausente o está vacío, establece 'equipment_id' como null.
            $userData['equipment_id'] = null;
        }

        return new User($userData);
    }

    public function rules(): array
    {
        return [
            '*.email' => ['required', 'unique:users'],
            '*.estado' => ['required'],
            '*.role' => ['rquired'],
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
