<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sobres', [TiendaController::class, 'index']);

Route::get('/sobres/abrir/{tipo}', [TiendaController::class, 'abrirSobre']);

Route::get('/pokedex', function () {
    return view('pokedex.pokedex');
});