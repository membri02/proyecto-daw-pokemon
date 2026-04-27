<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TiendaController extends Controller
{
    public function index()
    {
        return view('tienda.sobres');
    }
    

    public function abrirSobre($tipo)
    {
        // Capa de seguridad de backend — aunque el middleware ya lo cubre
        if (!Auth::check()) {
            return redirect('/sobres')->with('error', 'Debes iniciar sesión para abrir sobres.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $precios = [
            'fuego' => 100, 'agua' => 100, 'planta' => 100,
            'holo' => 500, 'legendario' => 1000
        ];

        if (!array_key_exists($tipo, $precios)) {
            return redirect('/sobres')->with('error', 'Ese sobre no existe en la tienda.');
        }

        $precioDelSobre = $precios[$tipo];

        if ($user->monedas < $precioDelSobre) {
            return redirect('/sobres')->with('error', '¡No tienes suficientes Pokémonedas!');
        }

        // 1. Cobramos el sobre por adelantado
        $user->monedas -= $precioDelSobre;

        // 2. Generamos las cartas 
        $cartas = collect();
        if (in_array($tipo, ['fuego', 'agua', 'planta'])) {
            $garantizadas = Carta::where('tipo', $tipo)->inRandomOrder()->limit(2)->get();
            $random = Carta::whereNotIn('id', $garantizadas->pluck('id'))->inRandomOrder()->limit(3)->get();
            $cartas = $garantizadas->concat($random);
        } elseif ($tipo === 'holo') {
            $garantizada = Carta::where('es_holo', true)->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        } elseif ($tipo === 'legendario') {
            $garantizada = Carta::where('es_legendario', true)->inRandomOrder()->limit(1)->get();
            $random = Carta::whereNotIn('id', $garantizada->pluck('id'))->inRandomOrder()->limit(4)->get();
            $cartas = $garantizada->concat($random);
        }

        // PLAN B: Si la base de datos está corrupta o el query estricto falla, rellenamos forzosamente a 5
        if ($cartas->count() < 5) {
            $faltantes = 5 - $cartas->count();
            $fallback = Carta::whereNotIn('id', $cartas->pluck('id'))->inRandomOrder()->limit($faltantes)->get();
            $cartas = $cartas->concat($fallback);
        }

        $cartas = $cartas->shuffle();

        // 3. SISTEMA DE REPETIDAS (El "Desencantar")
        $misCartasIds = $user->cartas()->pluck('cartas.id')->toArray(); // IDs que ya tiene el usuario
        $idsParaGuardar = [];
        $monedasReembolso = 0;

        foreach ($cartas as $carta) {
            // Comprobamos si ya la tiene (o si ha salido repetida en este mismo sobre)
            if (in_array($carta->id, $misCartasIds)) {
                $carta->es_repetida = true; // Etiqueta dinámica para la vista
                
                // Calculamos cuánto vale desencantarla
                if (str_contains($carta->rareza, 'Legendaria')) {
                    $reembolso = 100;
                } elseif (str_contains($carta->rareza, 'Rara')) {
                    $reembolso = 50;
                } else {
                    $reembolso = 20;
                }
                
                $monedasReembolso += $reembolso;
                $carta->reembolso = $reembolso;
            } else {
                // Es nueva, preparamos para guardarla
                $carta->es_repetida = false;
                $idsParaGuardar[] = $carta->id;
                $misCartasIds[] = $carta->id; // Al array por si el sobre trae 2 iguales
            }
        }

        // 4. Guardamos SOLAMENTE las cartas nuevas en el álbum
        if (!empty($idsParaGuardar)) {
            $user->cartas()->attach($idsParaGuardar);
        }

        // 5. Ingresamos el dinero de las repetidas y guardamos el usuario
        $user->monedas += $monedasReembolso;
        $user->save(); 

        // 6. Invalidamos la caché de la colección del usuario para que muestre las cartas nuevas
        Cache::forget('coleccion_usuario_' . $user->id);

        return view('tienda.apertura', compact('cartas', 'tipo', 'monedasReembolso'));
    }


    public function miAlbum()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Obtenemos la colección cacheada por 1 hora. Eager loading resuelve problemas de N+1
        $cartas = Cache::remember('coleccion_usuario_' . $user->id, 3600, function() use ($user) {
            $user->load(['cartas' => function ($query) {
                $query->orderBy('carta_id');
            }]);
            return $user->cartas;
        });

        return view('tienda.album', compact('cartas'));
    }
}