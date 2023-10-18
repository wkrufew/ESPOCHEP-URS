<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportarUsuariosController extends Controller
{
    public function importar()
    {
        return view('admin.importar-usuarios');
    }

    public function store(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:excel,xls,xlsx|max:2048',
        ]);

        $file = $request->file('import_file');
        Excel::import(new UserImport, $file);
        return redirect()->route('admin.asignacion-equipo.index')->with('success', 'Usuarios importados exitosamente');
    }
}
