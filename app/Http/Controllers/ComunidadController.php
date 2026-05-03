<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ComunidadController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->get();
        
        // Ranking Data
        $topMonedas = User::orderByDesc('monedas')->take(5)->get();
        $topColeccion = User::withCount('cartas')->orderByDesc('cartas_count')->take(5)->get();

        return view('comunidad.index', compact('posts', 'topMonedas', 'topColeccion'));
    }

    public function create()
    {
        return view('comunidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        Auth::user()->posts()->create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('comunidad.index')->with('success', '¡Hilo creado con éxito!');
    }

    public function show(Post $comunidad)
    {
        $comunidad->load(['user', 'comments.user']);
        return view('comunidad.show', ['post' => $comunidad]);
    }

    public function storeComment(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            'contenido' => 'required|string',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('comunidad.show', $post->id)->with('success', '¡Comentario añadido!');
    }
}
