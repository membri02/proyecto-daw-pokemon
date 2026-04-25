<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinijuegoController extends Controller
{
    public function win(){
        if(Auth::check()){
            $monedas = 50;

            $user = Auth::user();
            $user->increment('monedas', $monedas);

            return response()->json([
                'message' => "¡Ganaste {$monedas} monedas!",
                'monedas' => $user->monedas
            ]);
        }

        return response()->json([
            'message' => '¡Inicia sesión o registrate si quieres ganar monedas!'
        ]);
    }
}
