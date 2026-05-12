<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MinijuegoController;
use App\Http\Controllers\ComunidadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokedex', function () {
    return view('pokedex.pokedex');
});

Route::prefix('minijuego')->group(function () {
    Route::get('/', [MinijuegoController::class, 'index'])->name('minijuego.index');

    Route::middleware('auth')->group(function () {
        Route::get('/silueta', [MinijuegoController::class, 'silueta'])->name('minijuego.silueta');
        Route::get('/triler', [MinijuegoController::class, 'triler'])->name('minijuego.triler');
        Route::get('/duelo', [MinijuegoController::class, 'duelo'])->name('minijuego.duelo');
        Route::get('/memoria', [MinijuegoController::class, 'memoria'])->name('minijuego.memoria');

        Route::post('/reward', [MinijuegoController::class, 'processReward'])->name('minijuego.reward');
        Route::post('/duelo/validate', [MinijuegoController::class, 'validateDuel'])->name('minijuego.duelo.validate');
    });
});

Route::get('/sobres', [TiendaController::class, 'index'])->middleware('auth');
Route::get('/sobres/abrir/{tipo}', [TiendaController::class, 'abrirSobre'])->middleware('auth');

Route::get('/sobres', [TiendaController::class, 'index'])->name('tienda.index');

Route::post('/tienda/abrir/{tipo}', [TiendaController::class, 'abrirSobre'])
    ->middleware('auth')
    ->name('tienda.abrir');

Route::get('/album', [TiendaController::class, 'miAlbum'])->middleware('auth')->name('album');

Route::get('/tienda/recargar', [TiendaController::class, 'recargar'])->middleware('auth')->name('tienda.recargar');
Route::post('/tienda/procesar-pago', [TiendaController::class, 'procesarPago'])->middleware('auth')->name('tienda.procesar_pago');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');

Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\AdminController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [\App\Http\Controllers\ProfileController::class, 'index'])->name('perfil.index');
    Route::put('/perfil/update', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('perfil.update');
});

Route::middleware('auth')->group(function () {
    Route::resource('comunidad', ComunidadController::class)->except(['edit', 'update', 'destroy']);
    Route::post('comunidad/{post}/comments', [ComunidadController::class, 'storeComment'])->name('comunidad.comments.store');
});