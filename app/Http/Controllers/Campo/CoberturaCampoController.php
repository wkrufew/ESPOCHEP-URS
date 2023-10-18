<?php

namespace App\Http\Controllers\Campo;

use App\Exports\CoberturaExport;
use App\Exports\ConsolidadoCoberturasCampoExport;
use App\Exports\SeguimientoCampoExport;
use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CoberturaCampoController extends Controller
{
    public function export(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            // Validar que $phaseId sea un valor válido
            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new CoberturaExport($phase), 'cobertura-supervisor.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }

    public function exportSeguimientos(Request $request)
    {
        try {
            $phaseId = $request->input('phase');

            // Validar que $phaseId sea un valor válido
            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new SeguimientoCampoExport($phase), 'seguimientos-insitus.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }
    public function exportConsolidadoCoberturas(Request $request)
    {
        try {
            $phaseId = $request->input('phase');

            // Validar que $phaseId sea un valor válido
            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new ConsolidadoCoberturasCampoExport($phase), 'Cobertura-Consolidada.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
    }
}
