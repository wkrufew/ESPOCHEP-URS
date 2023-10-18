<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Admin\ImportarPlanificacionController;
use App\Http\Controllers\Admin\ImportarUsuariosController;
use App\Http\Controllers\Admin\MaterialesController;
use App\Livewire\Admin\AsignacionEquipo;
use App\Livewire\Admin\CantonComponent;
use App\Livewire\Admin\CertificadoComponent;
use App\Livewire\Admin\CertificadoEquipo;
use App\Livewire\Admin\CertificadoEstado;
use App\Livewire\Admin\CertificadoShow;
use App\Livewire\Admin\CreateAsignacion;
use App\Livewire\Admin\CreateEquipo;
use App\Livewire\Admin\CreatePlanificacion;
use App\Livewire\Admin\CreateUser;
use App\Livewire\Admin\EditarAsignacionEquipo;
use App\Livewire\Admin\EditAsignacion;
use App\Livewire\Admin\EditPlanificacion;
use App\Livewire\Admin\EquipoComponent;
use App\Livewire\Admin\FaseComponent;
use App\Livewire\Admin\GenerarStickers;
use App\Livewire\Admin\PlanificacionStatus;
use App\Livewire\Admin\ProvinciaComponent;
use App\Livewire\Admin\ShowAsignaciones;
use App\Livewire\Admin\ShowPlanificaciones;
use App\Livewire\Admin\ShowProvincias;
use App\Livewire\Admin\ShowZona;
use App\Livewire\Admin\StickerEquipo;
use App\Livewire\Admin\StickerListar;
use App\Livewire\Admin\StickerStatus;
use App\Livewire\Admin\ZonaComponent;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    /* PROVINCIAS */
    Route::get('provincias', ProvinciaComponent::class)->name('admin.provincias.index');
    /* CANTONES */
    Route::get('provincias/{province}', ShowProvincias::class)->name('admin.provincias.show');
    /* PARROQUIAS */
    Route::get('cantones/{canton}', CantonComponent::class)->name('admin.cantones.show');
    /* ZONAS */
    Route::get('zonas', ZonaComponent::class)->name('admin.zonas.index');
    /* SECTORES */
    Route::get('zonas/{zone}', ShowZona::class)->name('admin.zonas.show');
    /* FASES */
    Route::get('fases', FaseComponent::class)->name('admin.fases.index');
    /* PLANIFICACIONES */
    Route::get('planificaciones', ShowPlanificaciones::class)->name('admin.planificaciones.index');
    Route::get('planificaciones/create', CreatePlanificacion::class)->name('admin.planificaciones.create');
    Route::get('planificaciones/{planning}/edit', EditPlanificacion::class)->name('admin.planificaciones.edit');
    Route::get('planificaciones/importar', [ImportarPlanificacionController::class, 'importar'])->name('admin.planificaciones.import');
    Route::post('planificaciones/importar/store', [ImportarPlanificacionController::class, 'store'])->name('admin.planificaciones.store');
    //PARA CAMBIAR EL RANGO DE LAS PLANIFICACIONES
    Route::get('planificaciones/status', PlanificacionStatus::class)->name('admin.planificaciones-status.index');
    /* EQUIPOS */
    Route::get('equipos', EquipoComponent::class)->name('admin.equipos.index');
    Route::get('equipos/create', CreateEquipo::class)->name('admin.equipos.create');
    /* ASIGNACIONES */
    Route::get('asignaciones', ShowAsignaciones::class)->name('admin.asignaciones.index');
    Route::get('asignaciones/create', CreateAsignacion::class)->name('admin.asignaciones.create');
    Route::get('asignaciones/{assignment}/edit', EditAsignacion::class)->name('admin.asignaciones.edit');
    /* CERTIFICADOS */
    Route::get('certificados', CertificadoComponent::class)->name('admin.certificados.index');
    Route::get('certificados-buscar', CertificadoShow::class)->name('admin.certificados-buscar.index');
    Route::get('certificados-equipo', CertificadoEquipo::class)->name('admin.certificados-equipo.index');
    Route::get('certificados-estado', CertificadoEstado::class)->name('admin.certificados-estado.index');

    /* CERTIFICADOS */
    Route::get('stickers/generar', GenerarStickers::class)->name('admin.stickers.index');
    Route::get('stickers/listar', StickerListar::class)->name('admin.stickers.listar');
    Route::get('stickers/equipo', StickerEquipo::class)->name('admin.stickers.equipo');
    Route::get('stickers/status', StickerStatus::class)->name('admin.stickers.status');

    /* USUARIOS A EQUIPOAS */
    Route::get('user/create', CreateUser::class)->name('admin.user.create');
    Route::get('asignacion-equipo', AsignacionEquipo::class)->name('admin.asignacion-equipo.index');
    Route::get('asignacion-equipo/{user}/edit', EditarAsignacionEquipo::class)->name('admin.edit-asignacion-equipo.edit');
    /* IMPORTACION USUARIOS */
    Route::get('usuarios/importar', [ImportarUsuariosController::class, 'importar'])->name('admin.usuarios.import');
    Route::post('usuarios/importar/store', [ImportarUsuariosController::class, 'store'])->name('admin.usuarios.store');

    /* EXPORTAR COBERTURA DE LEVANTAMIENTO */
    Route::get('exportar-asignacion', [AsignacionController::class, 'export'])->name('admin.asignacion-exportar.index');

    /* EXPORTAR CERTIFICADOS */
    Route::get('exportar-certificados', [MaterialesController::class, 'certificados'])->name('admin.certificados-exportar.index');

    /* EXPORTAR STICKERS*/
    Route::get('exportar-stickers', [MaterialesController::class, 'stickers'])->name('admin.stickers-exportar.index');
    
});
