<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Require auth and specific email
        if (!Auth::check() || Auth::user()->email !== 'admin@pokemon.com') {
            return redirect('/')->with('error', 'Acceso denegado. Se requieren permisos de administrador.');
        }

        return $next($request);
    }
}
