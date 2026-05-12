<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $cartas_unicas = $user->cartas()->distinct('carta_id')->count('carta_id');
        
        $total_cartas = 151;
        
        $progreso = 0;
        if ($total_cartas > 0) {
            $progreso = round(($cartas_unicas / $total_cartas) * 100, 2);
        }

        return view('perfil.index', compact('user', 'cartas_unicas', 'total_cartas', 'progreso'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'La contraseña actual es incorrecta.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
