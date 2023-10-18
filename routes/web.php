<?php

use App\Livewire\NovedadesComponent;
use App\Livewire\SearchPlannings;
use App\Livewire\VerificarEquipo;
use App\Livewire\VerificarIntegrantes;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/novedades', NovedadesComponent::class)->name('novedades');
Route::get('/verificar-equipo', VerificarEquipo::class)->name('verificar-equipo');
Route::get('/verificar-integrantes', VerificarIntegrantes::class)->name('verigicar-integrantes');
Route::get('/verificar-planificaciones', SearchPlannings::class)->name('verificar-planificaciones');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/* FUNCIONES PARA PRODUCCION */

//RUTAS PARA LANZAR EN MODO PRODUCCION EN EL HOSTING COMPARTIDO

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache de la app eliminada';
});

 // borrar caché de ruta
 Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Cache de rutas eliminada';
});

// borrar caché de configuración
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Configuracion de cache eliminada';
}); 

// borrar caché de vista
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'Cache de vistas eliminada';
});

// optimmizar cache
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return 'Cache de vistas eliminada';
});

Route::get('storage-link', function () {
    $exitCode = Artisan::call('storage:link');
    return 'Simbolic Link establecido';
});

Route::get('modo-down', function () {
    $exitCode = Artisan::call('down --secret="consistelec2@23"');
    return 'El sistema esta en modo mantenimiento';
})->name('down');

Route::get('up', function () {
    $exitCode = Artisan::call('up');
    //return 'The system is already active';
    return back()->with('notificacion','Sistema en line');
})->name('up');

//ruta para refrescar la cache de la app
Route::get('/fresh', function() {
    $exitCode = Artisan::call('cache:clear');
    return back()->with('notificacion','System cache is up to date');
})->name('fresh');
