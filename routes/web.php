<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrutaController;
use App\Http\Controllers\UserController;

Route::get('/', [FrutaController::class, 'listar'])->name('home');
Route::post('/insertar', [FrutaController::class, 'insertar']);
Route::delete('/eliminar/{id}', [FrutaController::class, 'eliminar']);
Route::get('/editar/{id}', [FrutaController::class, 'mostrarFormularioDeEdicion']);
Route::put('/modificar', [FrutaController::class, 'modificar']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
