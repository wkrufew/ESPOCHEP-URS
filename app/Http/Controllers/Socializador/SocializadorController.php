<?php

namespace App\Http\Controllers\Socializador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocializadorController extends Controller
{
    public function index ()
    {
        return view('socializador.dashboard');
    }
}
