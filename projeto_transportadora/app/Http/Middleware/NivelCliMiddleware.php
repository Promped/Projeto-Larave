<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NivelCliMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (!Auth::check() || Auth:: user()->nivel !== 'CLI') {
            return redirect('/login')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }
        return $next($request);
    }
}
