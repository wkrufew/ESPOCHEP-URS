<?php

use App\Http\Controllers\Encuestador\EncuestadorController;
use App\Http\Controllers\Encuestador\ExportCoberturaController;
use App\Livewire\Encuestador\CreateCobertura;
use App\Livewire\Encuestador\EditCobertura;
use App\Livewire\Encuestador\EncuestadorComponent;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:encuestador'])->group(function () {
    Route::get('/dashboard', [EncuestadorController::class, 'index'])->name('encuestador.dashboard');

    /* COBERTURA DIARIA */
    Route::get('coberturas', EncuestadorComponent::class)->name('encuestador.coberturas.index');
    Route::get('coberturas/create', CreateCobertura::class)->name('encuestador.coberturas.create');
    Route::get('coberturas/{worker}/edit', EditCobertura::class)->name('encuestador.coberturas.edit');

    /* EXPORTAR COBERTURAS */
    Route::get('exportar-cobertura', [ExportCoberturaController::class, 'export'])->name('encuestador.exportar-cobertura.index');
});