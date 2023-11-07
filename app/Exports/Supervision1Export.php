<?php

namespace App\Exports;

use App\Models\Seguimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Supervision1Export implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $phase;

    public function __construct($phase)
    {
        $this->phase = $phase;
    }

    public function collection()
    {
        return Seguimiento::where('tipo', 'Supervision')
            ->join('plannings', 'seguimientos.planning_id', '=', 'plannings.id')
            ->leftJoin('certificados', 'seguimientos.certificado_id', '=', 'certificados.id')
            ->join('users', 'seguimientos.user_id', '=', 'users.id') // Agrega la relación con users
            ->leftJoin('equipments', 'users.equipment_id', '=', 'equipments.id')
            ->where('plannings.phase_id', '=', $this->phase->id)
            ->orderBy('plannings.codigo_manzana')
            ->orderBy('seguimientos.fecha_seguimiento')
            ->select([
                'users.name as nombre_usuario', // Nombre del usuario
                'equipments.name as nombre_equipo',
                'plannings.provincia as provincia',
                'plannings.canton as canton',
                'plannings.parroquia as parroquia',
                'plannings.areacensal as area',
                'plannings.codigo_manzana as Manzana',
                'plannings.tipo_sector as Tipo',
                'seguimientos.fecha_seguimiento',
                'certificados.code', // Campo de certi
                'seguimientos.ubicacion',
                'seguimientos.objetivo',
                'seguimientos.tipo_vivienda',
                'seguimientos.diligencia_preguntas',
                'seguimientos.miembros_hogar',
                'seguimientos.registro_nucleos',
                'seguimientos.numero_nucleos',
                'seguimientos.registro_certificado',
                'seguimientos.formulario_imagenes',
            ])->get();
    }

    public function headings(): array
    {
        return [
            'Nombre de Usuario', // Nombre del usuario
            'Equipo', // Nombre del usuario
            'Provincia',
            'Canton',
            'Parroquia',
            'Area Censal',
            'Codigo de Sector',
            'Tipo',
            'Fecha de Seguimiento',
            'Código de Certificado', // Campo de certificado
            'Ubicacion',
            'Objetivo',
            'Tipo de Vivienda',
            'Diligencia las Preguntas',
            'Miembros del Hogar',
            'Registro Nucleos',
            'Numero de Nucleos',
            'Registro Certificado',
            'Formulario con Imagenes',
        ];
    }
}
