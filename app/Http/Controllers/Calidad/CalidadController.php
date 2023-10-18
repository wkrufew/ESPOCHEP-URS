<?php

namespace App\Http\Controllers\Calidad;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class CalidadController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();

        return view('calidad.dashboard', compact('phases'));
    }
}
