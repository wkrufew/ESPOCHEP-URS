<?php

namespace App\Exports;

use App\Models\Seguimiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Seguimiento1Export implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $phase;

    public function __construct($phase)
    {
        $this->phase = $phase;
    }
    
    public function collection()
    {
        return Seguimiento::where('tipo', 'Seguimiento')
            ->join('plannings', 'seguimientos.planning_id', '=', 'plannings.id')
            ->leftJoin('certificados', 'seguimientos.certificado_id', '=', 'certificados.id')
            ->join('users', 'seguimientos.user_id', '=', 'users.id') // Agrega la relación con users
            ->leftJoin('equipments', 'users.equipment_id', '=', 'equipments.id')
            ->where('plannings.phase_id', '=', $this->phase->id)
            ->orderBy('plannings.codigo_manzana')
            ->orderBy('seguimientos.fecha_seguimiento')
            ->select([
                /* 'seguimientos.tipo', */
                'seguimientos.fecha_seguimiento',
                'users.name as nombre_usuario', // Nombre del usuario
                'equipments.name as nombre_equipo',
                'plannings.provincia as provincia',
                'plannings.canton as canton',
                'plannings.parroquia as parroquia',
                'plannings.codigo_manzana as Manzana',
                'certificados.code', // Campo de certificado
                /* 'seguimientos.observacion', */
                'seguimientos.registro_nombres',
                'seguimientos.registro_sexo',
                'seguimientos.registro_nacimiento',
                'seguimientos.registro_cedula',
                'seguimientos.registro_aparentesco_hogar',
                'seguimientos.registro_nucleos',
                'seguimientos.registro_aparentesco_nucleo',
                /* 'seguimientos.created_at', // Campo created_at de seguimientos */
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fecha de Seguimiento',
            /* 'Tipo', */
            /* 'Observación', */
            'Nombres',
            'Equipo',
            'Provincia',
            'Canton',
            'Parroquia',
            'Codigo Manzana',
            'Código de Certificado', // Campo de certificado
            'REGISTRO APELLIDOS Y NOMBRES',
            'REGISTRO SEXO',
            'REGISTRO FECHA DE NACIMIENTO',
            'REGISTRO CEDULA',
            'REGISTRO PARENTESCO JEFE DE HOGAR',
            'REGISTRO NUCLEOS',
            'REGISTRO PARENTESCO JEFE DE NUCLEO',
            /* 'Nombre de Usuario',  */// Nombre del usuario
            /* 'Fecha de Creación', */
        ];
    }

    /* 
    public function collection()
    {
        return Seguimiento::where('tipo', 'Seguimiento')
            ->join('plannings', 'seguimientos.planning_id', '=', 'plannings.id')
            ->leftJoin('certificados', 'seguimientos.certificado_id', '=', 'certificados.id')
            ->join('users', 'seguimientos.user_id', '=', 'users.id') // Agrega la relación con users
            ->orderBy('plannings.codigo_manzana')
            ->orderBy('seguimientos.fecha_seguimiento')
            ->select([
                'seguimientos.fecha_seguimiento',
                'seguimientos.tipo',
                'seguimientos.observacion',
                'seguimientos.registro_nombres',
                'seguimientos.registro_sexo',
                'seguimientos.registro_nacimiento',
                'seguimientos.registro_cedula',
                'seguimientos.registro_aparentesco_hogar',
                'seguimientos.registro_nucleos',
                'seguimientos.registro_aparentesco_nucleo',
                'certificados.code', // Campo de certificado
                'users.name as nombre_usuario', // Nombre del usuario
                'seguimientos.created_at', // Campo created_at de seguimientos
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fecha de Seguimiento',
            'Tipo',
            'Observación',
            'Nombres',
            'Sexo',
            'Fecha de Nacimiento',
            'Cédula',
            'Aparentesco Hogar',
            'Núcleos',
            'Aparentesco Núcleo',
            'Código de Certificado', // Campo de certificado
            'Nombre de Usuario', // Nombre del usuario
            'Fecha de Creación',
        ];
    }
    */
}
