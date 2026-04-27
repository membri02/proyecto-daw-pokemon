<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MinijuegoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokedex', function () {
    return view('pokedex.pokedex');
});

Route::get('/minijuego', function(){
    return view('minijuego.minijuego');
});
Route::post('/minijuego/win', [MinijuegoController::class, 'win']);

// RUTAS PROTEGIDAS POR SESIÓN (Tienda y Álbum)
Route::get('/sobres', [TiendaController::class, 'index'])->middleware('auth');
Route::get('/sobres/abrir/{tipo}', [TiendaController::class, 'abrirSobre'])->middleware('auth');

// Tienda: índice público (Pikachu actúa como guardián del frontend)
Route::get('/sobres', [TiendaController::class, 'index'])->name('tienda.index');

// Apertura de sobre: POST + auth (doble protección: middleware + Auth::check() en el controlador)
Route::post('/tienda/abrir/{tipo}', [TiendaController::class, 'abrirSobre'])
    ->middleware('auth')
    ->name('tienda.abrir');


Route::get('/album', [TiendaController::class, 'miAlbum'])->middleware('auth')->name('album');

// RUTAS DE RECARGA CON GOOGLE PAY
Route::get('/tienda/recargar', [TiendaController::class, 'recargar'])->middleware('auth')->name('tienda.recargar');
Route::post('/tienda/procesar-pago', [TiendaController::class, 'procesarPago'])->middleware('auth')->name('tienda.procesar_pago');

// RUTAS DE AUTENTICACIÓN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');

// RECIBIR DATOS DE LOS FORMULARIOS
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');