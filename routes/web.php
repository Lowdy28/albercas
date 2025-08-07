<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\UsuarioController; // <- CORREGIDO
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// RUTAS MEMBRESÍAS - SOLO ADMINISTRADOR
Route::middleware(['auth', 'rol:Administrador'])->group(function () {
    Route::get('membresias', [MembresiaController::class, 'list'])->name('membresias');
    Route::get('membresias/nueva', [MembresiaController::class, 'index'])->name('membresias.nueva');
    Route::post('membresias/nueva', [MembresiaController::class, 'crear'])->name('membresia.crear');
    Route::post('membresia/guardar', [MembresiaController::class, 'store'])->name('membresia.guardar');
    Route::get('membresias/{id}/edit', [MembresiaController::class, 'edit'])->name('membresia.nueva');
    Route::delete('membresias/{id}', [MembresiaController::class, 'destroy'])->name('membresia.destroy');
});

// RUTAS USUARIOS - SOLO ADMINISTRADOR
Route::middleware(['auth', 'rol:Administrador'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'list'])->name('usuarios');
    Route::get('usuarios/nuevaU', [UsuarioController::class, 'index'])->name('usuarios.nuevaU');
    Route::get('/usuarios/nuevo', [UsuarioController::class, 'index']);
    Route::post('/usuarios/crear', [UsuarioController::class, 'crear']);
    Route::post('/usuarios/store', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'edit']);
    Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy']);
});

// RUTAS CLASES - SOLO PROFESOR
Route::middleware(['auth', 'rol:Profesor'])->group(function () {
    Route::get('/clases', [ClaseController::class, 'list'])->name('clases.lista');
    Route::get('/clases/nueva', [ClaseController::class, 'index'])->name('clases.nueva');
    Route::post('/clases/crear', [ClaseController::class, 'crear'])->name('clases.crear');
    Route::post('/clases/guardar', [ClaseController::class, 'store'])->name('clases.guardar');
    Route::get('/clases/{id}/edit', [ClaseController::class, 'edit'])->name('clases.editar');
    Route::delete('/clases/{id}', [ClaseController::class, 'destroy'])->name('clases.destroy');
});

// RUTA POLÍTICAS PRIVACIDAD
Route::get('/privacidad', [HomeController::class, 'privacidad'])->name('privacidad');

// RUTAS RESTABLECER CONTRASEÑA
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// RUTAS GOOGLE LOGIN
Route::get('/auth/redirect/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/callback/google', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
