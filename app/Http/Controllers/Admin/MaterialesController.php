<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CertificadosExport;
use App\Exports\StickersExport;
use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Sticker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MaterialesController extends Controller
{
    /* private $startDate;
    private $endDate;

    public function __construct(Request $request)
    {
        $this->startDate = $request->input('start_date');
        $this->endDate = $request->input('end_date');
    } */

    public function certificados(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        /* try { */
            $data = Certificado::whereBetween('created_at', [$startDate, $endDate])->orderBy('code', 'asc')->get();

            return Excel::download(new CertificadosExport($data), 'certificados-logistica.xlsx');
        /* } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Error sin datos.');
        } */
    }

    public function stickers(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        /* try { */
            $data = Sticker::whereBetween('created_at', [$startDate, $endDate])->orderBy('code', 'asc')->get();

            return Excel::download(new StickersExport($data), 'stickers-logistica.xlsx');
        /* } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Error sin datos.');
        } */
    }
}
