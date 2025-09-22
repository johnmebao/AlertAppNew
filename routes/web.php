<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PersonalController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AlertaPanicosController;
use App\Http\Controllers\Auth\LoginController;

//3116132539

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//RUTAS PARA LA CONFIGURACION DE LA APLICACION
Route::get('/admin/configuracion', [ConfiguracionController::class, 'index'])->name('admin.configuracion.index')->middleware('auth', 'can:admin.configuracion.index');
Route::post('/admin/configuracion/create', [ConfiguracionController::class, 'store'])->name('admin.configuracion.store')->middleware('auth', 'can:admin.configuracion.store');

// RUTAS PARA LA GESTION DE SEDES
Route::get('/admin/sedes', [SedeController::class, 'index'])->name('admin.sedes.index')->middleware('auth', 'can:admin.sedes.index');
Route::get('/admin/sedes/create', [SedeController::class, 'create'])->name('admin.sedes.create')->middleware('auth', 'can:admin.sedes.create');
Route::post('/admin/sedes/create', [SedeController::class, 'store'])->name('admin.sedes.store')->middleware('auth', 'can:admin.sedes.store');
Route::get('/admin/sedes/edit/{id}', [SedeController::class, 'edit'])->name('admin.sedes.edit')->middleware('auth', 'can:admin.sedes.edit');
Route::put('/admin/sedes/{id}', [SedeController::class, 'update'])->name('admin.sedes.update')->middleware('auth', 'can:admin.sedes.update');
Route::delete('/admin/sedes/delete/{id}', [SedeController::class, 'destroy'])->name('admin.sedes.destroy')->middleware('auth', 'can:admin.sedes.destroy');

// RUTAS PARA LA GESTION DE ROLES
Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth', 'can:admin.roles.index');
Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth', 'can:admin.roles.create');
Route::post('/admin/roles/create', [RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth', 'can:admin.roles.store');
Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth', 'can:admin.roles.edit');
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth', 'can:admin.roles.update');
Route::delete('/admin/roles/delete/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth', 'can:admin.roles.destroy');
Route::get('/admin/roles/permisos/{id}', [RoleController::class, 'permiso'])->name('admin.roles.permiso')->middleware('auth', 'can:admin.roles.permiso');
Route::put('/admin/roles/permisos/{id}', [RoleController::class, 'actualizar_permiso'])->name('admin.roles.actualizar_permiso')->middleware('auth', 'can:admin.roles.actualizar_permiso');


// RUTAS PARA LA GESTIÓN DE PERSONAL
Route::get('/admin/personal', [PersonalController::class, 'index'])->name('admin.personal.index')->middleware('auth', 'can:admin.personal.index');
Route::get('/admin/personal/create', [PersonalController::class, 'create'])->name('admin.personal.create')->middleware('auth', 'can:admin.personal.create');
Route::post('/admin/personal/create', [PersonalController::class, 'store'])->name('admin.personal.store')->middleware('auth', 'can:admin.personal.store');
Route::get('/admin/personal/edit/{id}', [PersonalController::class, 'edit'])->name('admin.personal.edit')->middleware('auth', 'can:admin.personal.edit');
Route::put('/admin/personal/{id}', [PersonalController::class, 'update'])->name('admin.personal.update')->middleware('auth', 'can:admin.personal.update');
Route::delete('/admin/personal/delete/{id}', [PersonalController::class, 'destroy'])->name('admin.personal.destroy')->middleware('auth', 'can:admin.personal.destroy');

// RUTAS PARA LA ACTIVACIÓN DEL BOTÓN DE PÁNICO
Route::middleware(['auth'])->group(function () {
    Route::get('alerta/configuracion', [AlertaPanicosController::class, 'config'])->name('alerta.configuracion')->middleware('auth','can:alerta.configuracion');
    Route::post('alerta/configuracion', [AlertaPanicosController::class, 'guardarConfiguracion'])->name('alerta.guardar_configuracion')->middleware('auth','can:alerta.guardar_configuracion');
    Route::get('alerta/boton-panico', [AlertaPanicosController::class, 'mostrarBoton'])->name('alerta.boton.mostrar')->middleware('auth','can:alerta.boton.mostrar');
    Route::post('alerta/boton-panico', [AlertaPanicosController::class, 'activarPanico'])->name('alerta.boton.panico')->middleware('auth','can:alerta.boton.panico');
});
