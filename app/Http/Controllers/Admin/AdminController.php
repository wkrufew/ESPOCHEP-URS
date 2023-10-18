<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index ()
    {
        $phases = Phase::all();
        return view('admin.dashboard', compact('phases'))->layout('layouts.admin');
    }
}
