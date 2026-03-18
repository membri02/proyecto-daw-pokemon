<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController; 
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokedex', function () {
    return view('pokedex.pokedex');
});

// RUTAS PROTEGIDAS POR SESIÓN (Tienda y Álbum)
Route::get('/sobres', [TiendaController::class, 'index'])->middleware('auth');
Route::get('/sobres/abrir/{tipo}', [TiendaController::class, 'abrirSobre'])->middleware('auth');
Route::get('/album', [TiendaController::class, 'miAlbum'])->middleware('auth')->name('album');

// RUTAS DE AUTENTICACIÓN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');

// RECIBIR DATOS DE LOS FORMULARIOS
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');