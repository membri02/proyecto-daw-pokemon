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

// RUTAS DE ADMINISTRACIÓN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('users.destroy');
});

// RUTAS DE PERFIL DE ENTRENADOR
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [\App\Http\Controllers\ProfileController::class, 'index'])->name('perfil.index');
    Route::put('/perfil/update', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('perfil.update');
});