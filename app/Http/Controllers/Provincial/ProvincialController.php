<?php

namespace App\Http\Controllers\Provincial;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class ProvincialController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();
        return view('provincial.dashboard', compact('phases'));
    }
}
