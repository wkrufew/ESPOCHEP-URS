<?php

use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Provincial\ProvincialController;
use App\Livewire\Provincial\CoberturaEquipos;
use App\Livewire\Provincial\CoberturaSectores;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:provincial'])->group(function () {
    Route::get('/dashboard', [ProvincialController::class, 'index'])->name('provincial.dashboard');

    /*VER COBERTURAS POR TIPO DE SECTOR*/
    Route::get('coberturas-sector', CoberturaSectores::class)->name('provincial.coberturas.index');

    /*VER COBERTURAS POR EQUIPO*/
    Route::get('coberturas-equipos', CoberturaEquipos::class)->name('provincial.coberturas.equipos');

    /* EXPORTAR COBERTURAS */
    Route::get('exportar-asignacion', [AsignacionController::class, 'export'])->name('provincial.asignacion-exportar.index');

    /* Route::get('exportar-seguimiento', [ExportSeguimientoController::class, 'export'])->name('gerencia.exportar-seguimiento.index');
    Route::get('exportar-seguimiento-total', [ExportSeguimientoController::class, 'export_total'])->name('gerencia.exportar-seguimiento-total.index'); */
});
