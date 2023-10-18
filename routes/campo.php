<?php

use App\Http\Controllers\Campo\CampoController;
use App\Http\Controllers\Campo\CoberturaCampoController;
use App\Livewire\Campo\CampoComponent;
use App\Livewire\Campo\CreateCertificado;
use App\Livewire\Campo\CreateCobertura;
use App\Livewire\Campo\CreateSeguimiento;
use App\Livewire\Campo\EditCobertura;
use App\Livewire\Campo\EditSeguimiento;
use App\Livewire\Campo\EquipoCobertura;
use App\Livewire\Campo\ListadoCobertura;
use App\Livewire\Campo\ListadpCertificado;
use App\Livewire\Campo\StatusCertificado;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:campo'])->group(function () {
    Route::get('/campo/dashboard', [CampoController::class, 'index'])->name('campo.dashboard');

    //SEGUIMIENTOS/SUPERVISIONES
    Route::get('seguimientos', CampoComponent::class)->name('campo.seguimientos.index');
    Route::get('seguimientos/create', CreateSeguimiento::class)->name('campo.seguimientos.create');
    Route::get('seguimientos/{seguimiento}/edit', EditSeguimiento::class)->name('campo.seguimientos.edit');

    /* COBERTURA DIARIA */
    Route::get('coberturas', ListadoCobertura::class)->name('campo.coberturas.index');
    Route::get('coberturas/create', CreateCobertura::class)->name('campo.coberturas.create');
    Route::get('coberturas/{worker}/edit', EditCobertura::class)->name('campo.coberturas.edit');

    //LISTADOS
    Route::get('certificados/listados', ListadpCertificado::class)->name('campo.certificados.listados');
    //CREAR CERTIFICADOS
    Route::get('certificados/create', CreateCertificado::class)->name('campo.certificados.create');
    //ESTADOS
    Route::get('certificados/estados', StatusCertificado::class)->name('campo.certificados.status');

    /*VER COBERTURAS del EQUIPO*/
    Route::get('coberturas-equipo', EquipoCobertura::class)->name('campo.cobertura.equipo');

    /* EXPORTAR COBERTURAS */
    Route::get('exportar-cobertura', [CoberturaCampoController::class, 'export'])->name('campo.exportar-cobertura.index');

    /* EXPORTAR SEGUIMIENTOS/SUPERVISIONES */
    Route::get('exportar-seguimientos', [CoberturaCampoController::class, 'exportSeguimientos'])->name('campo.exportar-seguimientos.index');
    /* EXPORTAR COBERTURAS CONSOLIDADAS*/
    Route::get('exportar-coberturas-consolidadas', [CoberturaCampoController::class, 'exportConsolidadoCoberturas'])->name('campo.exportar-coberturas-consolidadas.index');
});