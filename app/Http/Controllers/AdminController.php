<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCartas = DB::table('carta_user')->count();
        $totalMonedas = User::sum('monedas');

        return view('admin.dashboard', compact('totalUsers', 'totalCartas', 'totalMonedas'));
    }

    public function users()
    {
        $users = User::withCount('cartas')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'monedas' => 'required|integer|min:0'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'monedas' => $request->monedas,
        ]);

        session()->flash('success', 'Usuario creado correctamente.');
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'monedas' => 'required|integer|min:0'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->monedas = $request->monedas;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        session()->flash('success', 'Usuario actualizado correctamente.');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->email === 'admin@pokemon.com') {
            session()->flash('error', 'No puedes eliminar al administrador principal.');
            return redirect()->route('admin.users.index');
        }

        $user->delete();

        session()->flash('success', 'Usuario eliminado correctamente.');
        return redirect()->route('admin.users.index');
    }
}
