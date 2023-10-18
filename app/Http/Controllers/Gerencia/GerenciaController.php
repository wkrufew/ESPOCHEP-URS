<?php

namespace App\Http\Controllers\Gerencia;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class GerenciaController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();
        return view('gerencia.dashboard', compact('phases'));
    }
}
