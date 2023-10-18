<?php

namespace App\Http\Controllers\Encuestador;

use App\Exports\CoberturaExport;
use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportCoberturaController extends Controller
{
    public function export(Request $request) 
    {
        try {
            $phaseId = $request->input('phase');

            //dd($phaseId);
            // Validar que $phaseId sea un valor válido
            $phase = Phase::findOrFail($phaseId);

            return Excel::download(new CoberturaExport($phase), 'cobertura.xlsx');
        } catch (ModelNotFoundException $e) {
            // Manejar la excepción cuando el ID no existe
            return back()->with('error', 'La fase seleccionada no existe en la base de datos.');
        }
        
        /* return Excel::download(new CoberturaExport, 'users.xlsx'); */
    }
}
