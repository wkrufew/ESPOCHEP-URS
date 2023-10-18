<?php

namespace App\Http\Controllers\Encuestador;

use App\Http\Controllers\Controller;
use App\Models\Phase;

class EncuestadorController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();
        return view('encuestador.dashboard', compact('phases'))->layout('layouts.encuestador');
    }
}
