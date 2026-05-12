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

        $user->monedas -= $precioDelSobre;

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

        if ($cartas->count() < 5) {
            $faltantes = 5 - $cartas->count();
            $fallback = Carta::whereNotIn('id', $cartas->pluck('id'))->inRandomOrder()->limit($faltantes)->get();
            $cartas = $cartas->concat($fallback);
        }

        $cartas = $cartas->shuffle();

        $misCartasIds = $user->cartas()->pluck('cartas.id')->toArray();
        $idsParaGuardar = [];
        $monedasReembolso = 0;

        foreach ($cartas as $carta) {
            if (in_array($carta->id, $misCartasIds)) {
                $carta->es_repetida = true;
                
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
                $carta->es_repetida = false;
                $idsParaGuardar[] = $carta->id;
                $misCartasIds[] = $carta->id;
            }
        }

        if (!empty($idsParaGuardar)) {
            $user->cartas()->attach($idsParaGuardar);
        }

        $user->monedas += $monedasReembolso;
        $user->save(); 

        Cache::forget('coleccion_usuario_' . $user->id);

        return view('tienda.apertura', compact('cartas', 'tipo', 'monedasReembolso'));
    }


    public function miAlbum()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $cartas = Cache::remember('coleccion_usuario_' . $user->id, 3600, function() use ($user) {
            $user->load(['cartas' => function ($query) {
                $query->orderBy('carta_id');
            }]);
            return $user->cartas;
        });

        return view('tienda.album', compact('cartas'));
    }

    public function recargar()
    {
        return view('tienda.recarga');
    }

    public function procesarPago(Request $request)
    {
        $request->validate([
            'monedas' => 'required|integer'
        ]);

        $monedas = (int) $request->monedas;

        $packsPermitidos = [500, 1200, 2500];
        
        if (!in_array($monedas, $packsPermitidos)) {
            return response()->json([
                'success' => false,
                'message' => 'Cantidad de monedas inválida o manipulación detectada.'
            ], 400);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->monedas += $monedas;
        $user->save();

        Cache::forget('coleccion_usuario_' . $user->id);

        return response()->json([
            'success' => true,
            'message' => '¡Pago procesado con éxito! Se han añadido ' . $monedas . ' monedas a tu cuenta.',
            'monedas_actuales' => $user->monedas
        ]);
    }
}