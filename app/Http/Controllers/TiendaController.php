<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carta;
use Illuminate\Support\Facades\Auth;

class TiendaController extends Controller
{
    public function index()
    {
        return view('tienda.sobres');
    }

    public function abrirSobre($tipo)
    {
        // 1. Identificamos quién es el comprador
        $user = Auth::user();

        // 2. Definimos los precios oficiales en el servidor (Inhackeable)
        $precios = [
            'fuego' => 100,
            'agua' => 100,
            'planta' => 100,
            'holo' => 500,
            'legendario' => 1000
        ];

        // Por si alguien intenta poner una URL rara como /sobres/abrir/inventado
        if (!array_key_exists($tipo, $precios)) {
            return redirect('/sobres')->with('error', 'Ese sobre no existe en la tienda.');
        }

        $precioDelSobre = $precios[$tipo];

        // 3. El Cajero comprueba la cartera
        if ($user->monedas < $precioDelSobre) {
            return redirect('/sobres')->with('error', '¡No tienes suficientes Pokémonedas! Necesitas ' . $precioDelSobre . ' 🪙.');
        }

        // 4. ¡Cobramos! (Restamos el dinero y guardamos)
        $user->monedas -= $precioDelSobre;
        // 1. Identificamos quién es el comprador
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->save();

        // 5. Generamos las cartas 
        $cartas = collect();
        if (in_array($tipo, ['fuego', 'agua', 'planta'])) {
            $garantizadas = Carta::where('tipo', $tipo)->inRandomOrder()->limit(2)->get();
            $random = Carta::whereNotIn('id', $garantizadas->pluck('id'))->inRandomOrder()->limit(3)->get();
            $cartas = $garantizadas->concat($random);
        } elseif ($tipo === 'holo') {
            $garantizada = Carta::where('rareza', 'Rara Holo')->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        } elseif ($tipo === 'legendario') {
            $garantizada = Carta::where('rareza', 'Legendaria ✨')->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        }

        $cartas = $cartas->shuffle();

        // 6. ¡MAGIA! Guardamos estas 5 cartas en el álbum del jugador
        $user->cartas()->attach($cartas->pluck('id'));

        return view('tienda.apertura', compact('cartas', 'tipo'));
    }
}