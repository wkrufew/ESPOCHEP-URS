<?php

namespace App\Http\Controllers\Campo;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class CampoController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();
        return view('campo.dashboard', compact('phases'));
    }
}
