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
        $cartas = collect(); // Creamos una caja vacía para ir metiendo las cartas

        // LÓGICA SOBRES BÁSICOS (2 de su tipo + 3 al azar)
        if (in_array($tipo, ['fuego', 'agua', 'planta'])) {
            // Cogemos 2 cartas garantizadas del tipo seleccionado
            $garantizadas = Carta::where('tipo', $tipo)->inRandomOrder()->limit(2)->get();
            
            // Cogemos 3 cartas de CUALQUIER tipo que no sean las que ya han tocado
            $random = Carta::whereNotIn('id', $garantizadas->pluck('id'))->inRandomOrder()->limit(3)->get();
            
            $cartas = $garantizadas->concat($random);
        } 
        // LÓGICA SOBRE HOLO (1 Rara garantizada + 4 al azar)
        elseif ($tipo === 'holo') {
            $garantizada = Carta::where('rareza', 'Rara Holo')->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        }
        // LÓGICA SOBRE LEGENDARIO (1 Legendaria garantizada + 4 al azar)
        elseif ($tipo === 'legendario') {
            $garantizada = Carta::where('rareza', 'Legendaria ✨')->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        }

        // Si la base de datos está vacía y devuelve 0 cartas, evitamos que explote
        if ($cartas->count() < 5) {
            return redirect('/sobres')->with('error', 'No hay suficientes cartas en la base de datos para abrir este sobre.');
        }

        // Barajamos las 5 cartas para que la garantizada no sea siempre la primera
        $cartas = $cartas->shuffle();

        return view('tienda.apertura', compact('cartas', 'tipo'));
    }
}