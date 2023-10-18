<?php

namespace App\Http\Controllers\Gerencia;

use App\Exports\Seguimiento1Export;
use App\Exports\SeguimientoExport;
use App\Exports\SeguimientoTotalExport;
use App\Exports\Supervision1Export;
use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportSeguimientoController extends Controller
{
    public function export(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            //dd($phaseId);

            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new SeguimientoExport($phase), 'Seguimiento-Supervision.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }

    public function export_total(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            //dd($phaseId);

            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new SeguimientoTotalExport($phase), 'Seguimiento-Supervision-General.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }

    public function seguimientos1(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new Seguimiento1Export($phase), 'Seguimiento-1-1.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }

    public function supervisiones1(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new Supervision1Export($phase), 'Supervision-1-1.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }
    
}
