<?php

use App\Models\Membresia;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Types\Relations\Role;

use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('membresias', [MembresiaController::class, 'list'])->name('membresias')->middleware(['auth', 'rol:Administrador']);
Route::get('membresias/nueva', [MembresiaController::class, 'index'])->name('membresias.nueva')->middleware(['auth', 'rol:Administrador']);
Route::post('membresias/nueva', [MembresiaController::class, 'crear'])->name('membresia.crear')->middleware(['auth', 'rol:Administrador']);
Route::post('membresia/guardar', [MembresiaController::class, 'store'])->name('membresia.guardar')->middleware(['auth', 'rol:Administrador']);
Route::get('membresias/{id}/edit', [MembresiaController::class, 'edit'])->name('membresia.nueva')->middleware(['auth', 'rol:Administrador']);
Route::delete('membresias/{id}', [MembresiaController::class, 'destroy'])->name('membresia.destroy')->middleware(['auth', 'rol:Administrador']);


Route::get('usuarios/nuevaU', [UsuariosController::class, 'index'])->name('usuarios.nuevaU')->middleware(['auth', 'rol:Administrador']);
Route::get('/usuarios', [UsuariosController::class, 'list'])->name('usuarios')->middleware(['auth', 'rol:Administrador']);
Route::get('/usuarios/nuevo', [UsuariosController::class, 'index'])->middleware(['auth', 'rol:Administrador']);
Route::post('/usuarios/crear', [UsuariosController::class, 'crear'])->middleware(['auth', 'rol:Administrador']);
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store')->middleware(['auth', 'rol:Administrador']);
Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'edit'])->middleware(['auth', 'rol:Administrador']);
Route::delete('/usuarios/eliminar/{id}', [UsuariosController::class, 'destroy'])->middleware(['auth', 'rol:Administrador']);



Route::get('/clases', [ClaseController::class, 'list'])->name('clases.lista')->middleware(['auth', 'rol:Profesor']);
Route::get('/clases/nueva', [ClaseController::class, 'index'])->name('clases.nueva')->middleware(['auth', 'rol:Profesor']);
Route::post('/clases/crear', [ClaseController::class, 'crear'])->name('clases.crear')->middleware(['auth', 'rol:Profesor']);
Route::post('/clases/guardar', [ClaseController::class, 'store'])->name('clases.guardar')->middleware(['auth', 'rol:Profesor']);
Route::get('/clases/{id}/edit', [ClaseController::class, 'edit'])->name('clases.editar')->middleware(['auth', 'rol:Profesor']);
Route::delete('/clases/{id}', [ClaseController::class, 'destroy'])->name('clases.destroy')->middleware(['auth', 'rol:Profesor']);



Route::get('/privacidad', [HomeController::class, 'privacidad'])->name('privacidad');


Route::get('/ver-logs', [LogViewerController::class, 'verLogs'])->middleware('auth');
