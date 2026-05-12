<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinijuegoController extends Controller
{
    private $typeAdvantages = [
        'normal' => [],
        'fire' => ['grass', 'ice', 'bug', 'steel'],
        'water' => ['fire', 'ground', 'rock'],
        'grass' => ['water', 'ground', 'rock'],
        'electric' => ['water', 'flying'],
        'ice' => ['grass', 'ground', 'flying', 'dragon'],
        'fighting' => ['normal', 'ice', 'rock', 'dark', 'steel'],
        'poison' => ['grass', 'fairy'],
        'ground' => ['fire', 'electric', 'poison', 'rock', 'steel'],
        'flying' => ['grass', 'fighting', 'bug'],
        'psychic' => ['fighting', 'poison'],
        'bug' => ['grass', 'psychic', 'dark'],
        'rock' => ['fire', 'ice', 'flying', 'bug'],
        'ghost' => ['psychic', 'ghost'],
        'dragon' => ['dragon'],
        'dark' => ['psychic', 'ghost'],
        'steel' => ['ice', 'rock', 'fairy'],
        'fairy' => ['fighting', 'dragon', 'dark'],
    ];

    public function index() {
        return view('minijuegos.index');
    }

    public function silueta() {
        return view('minijuegos.silueta');
    }

    public function triler() {
        return view('minijuegos.triler');
    }

    public function duelo() {
        return view('minijuegos.duelo');
    }

    public function memoria() {
        return view('minijuegos.memoria');
    }

    public function processReward(Request $request) {
        if (!Auth::check() || !$request->user()) {
            return response()->json(['success' => false, 'message' => '¡Inicia sesión o regístrate para jugar y ganar monedas!'], 401);
        }

        $request->validate([
            'amount' => 'required|integer|min:-200|max:200',
            'game' => 'required|string'
        ]);

        $monedas = $request->amount;
        $user = $request->user();

        if ($monedas > 0) {
            $user->increment('monedas', $monedas);
        } else if ($monedas < 0) {
            $descuento = abs($monedas);
            if ($user->monedas < $descuento) {
                $user->update(['monedas' => 0]);
            } else {
                $user->decrement('monedas', $descuento);
            }
        }
        
        $user->refresh();

        \Illuminate\Support\Facades\Cache::forget('coleccion_usuario_' . $user->id);

        $mensaje = $monedas > 0 
            ? "¡Ganaste {$monedas} monedas en " . ucfirst($request->game) . "!" 
            : "¡Perdiste " . abs($monedas) . " monedas en " . ucfirst($request->game) . "!";

        return response()->json([
            'success' => true,
            'message' => $mensaje,
            'monedas' => $user->monedas
        ]);
    }

    public function validateDuel(Request $request) {
        $request->validate([
            'attack_type' => 'required|string',
            'defend_type' => 'required|string'
        ]);

        $attack = strtolower($request->attack_type);
        $defend = strtolower($request->defend_type);

        $isEffective = false;
        if (isset($this->typeAdvantages[$attack]) && in_array($defend, $this->typeAdvantages[$attack])) {
            $isEffective = true;
        }

        if ($isEffective) {
            return response()->json(['success' => true, 'message' => '¡Es súper efectivo!']);
        } else {
            return response()->json(['success' => false, 'message' => 'No es muy efectivo...']);
        }
    }
}
