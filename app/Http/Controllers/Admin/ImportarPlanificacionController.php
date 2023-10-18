<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PlanningsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportarPlanificacionController extends Controller
{
    public function importar()
    {
        return view('admin.importar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:excel,xls,xlsx|max:2048', // Puedes personalizar las extensiones y el tamaño permitido
        ]);

        $file = $request->file('import_file');
        Excel::import(new PlanningsImport, $file);
        return redirect()->route('admin.planificaciones.index')->with('success', 'Planificaciones importada exitosamente');
    }
}
