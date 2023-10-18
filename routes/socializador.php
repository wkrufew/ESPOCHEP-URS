<?php

use App\Http\Controllers\Socializador\SocializadorController;
use App\Livewire\Socializador\CreateSocializador;
use App\Livewire\Socializador\EditSocializador;
use App\Livewire\Socializador\SocializadorComponent;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:socializador'])->group(function () {
    Route::get('/dashboard', [SocializadorController::class, 'index'])->name('socializador.dashboard');

    /* SOCIALIZADOR */
    Route::get('/novedades', SocializadorComponent::class)->name('socializador.index');
    Route::get('novedades/create', CreateSocializador::class)->name('socializador.create');
    Route::get('novedades/{socializacion}/edit', EditSocializador::class)->name('socializador.edit');
});
