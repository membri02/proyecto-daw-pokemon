<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carta; // 

class TiendaController extends Controller
{
    public function index()
    {
        return view('tienda.sobres');
    }

    public function abrirSobre($tipo)
    {
        // 1. Extraemos las 5 cartas de la base de datos
        $cartas = Carta::where('tipo', $tipo)
                       ->inRandomOrder()
                       ->limit(5)
                       ->get();

        // 2. Control de seguridad por si el sobre está vacío
        if ($cartas->isEmpty()) {
            return redirect('/sobres')->with('error', 'Aún no hay cartas de tipo ' . $tipo);
        }

        // 3. Pasamos las cartas y el tipo a una nueva vista
        return view('tienda.apertura', compact('cartas', 'tipo'));
    }
}