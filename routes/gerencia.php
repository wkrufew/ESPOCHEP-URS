<?php

use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Gerencia\ExportSeguimientoController;
use App\Http\Controllers\Gerencia\GerenciaController;
use App\Livewire\Gerencia\CoberturasEquipos;
use App\Livewire\Gerencia\CoberturasSectores;
use App\Livewire\Gerencia\GraficoComparativo;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','role:gerencia'])->group(function () {
    Route::get('/gerencia/dashboard', [GerenciaController::class, 'index'])->name('gerencia.dashboard');

    /*VER COBERTURAS POR TIPO DE SECTOR*/
    Route::get('coberturas-sector', CoberturasSectores::class)->name('gerencia.coberturas.index');

    /*VER COBERTURAS POR EQUIPO*/
    Route::get('coberturas-equipos', CoberturasEquipos::class)->name('gerencia.coberturas.equipos');

    /*GRAFICO ESTADISTICO*/
    Route::get('coberturas-grafico', GraficoComparativo::class)->name('gerencia.coberturas.grafico');

    /* EXPORTAR COBERTURAS */
    Route::get('exportar-asignacion', [AsignacionController::class, 'export'])->name('gerencia.asignacion-exportar.index');

    Route::get('exportar-seguimiento', [ExportSeguimientoController::class, 'export'])->name('gerencia.exportar-seguimiento.index');
    Route::get('exportar-seguimiento-total', [ExportSeguimientoController::class, 'export_total'])->name('gerencia.exportar-seguimiento-total.index');

    Route::get('exportar-seguimientos-1-1', [ExportSeguimientoController::class, 'seguimientos1'])->name('gerencia.exportar-seguimientos-1-1.index');
    Route::get('exportar-supervisiones-1-1', [ExportSeguimientoController::class, 'supervisiones1'])->name('gerencia.exportar-supervisiones-1-1.index');
});
