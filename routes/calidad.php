<?php

use App\Http\Controllers\Calidad\CalidadController;
use App\Http\Controllers\Campo\CoberturaCampoController;
use App\Livewire\Calidad\CreateSeguimiento;
use App\Livewire\Calidad\EditSeguimiento;
use App\Livewire\Calidad\EquiposCobertura;
use App\Livewire\Calidad\ListarSeguimientos;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:calidad'])->group(function () {
    Route::get('/dashboard', [CalidadController::class, 'index'])->name('calidad.dashboard');

    //SEGUIMIENTOS/SUPERVISIONES
    Route::get('seguimientos', ListarSeguimientos::class)->name('calidad.seguimientos.index');
    Route::get('seguimientos/create', CreateSeguimiento::class)->name('calidad.seguimientos.create');
    Route::get('seguimientos/{seguimiento}/edit', EditSeguimiento::class)->name('calidad.seguimientos.edit');

    /*VER COBERTURAS DE EQUIPOS*/
    Route::get('coberturas-equipos', EquiposCobertura::class)->name('calidad.coberturas.equipos');

    //EXPORTAR SEGUIMIENTOS
    Route::get('exportar-seguimientos', [CoberturaCampoController::class, 'exportSeguimientos'])->name('calidad.exportar-seguimientos.index');

});
