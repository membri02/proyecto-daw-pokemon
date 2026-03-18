<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController; 
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sobres', [TiendaController::class, 'index']);

Route::get('/sobres/abrir/{tipo}', [TiendaController::class, 'abrirSobre']);

Route::get('/pokedex', function () {
    return view('pokedex.pokedex');
});

//rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');

// RECIBIR DATOS DE LOS FORMULARIOS
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');