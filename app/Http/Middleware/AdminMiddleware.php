<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Solo permite el acceso a usuarios con role = 'admin'.
     * Los usuarios regulares (role = 'user') son redirigidos al home.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Acceso restringido. Se requiere perfil administrador.');
        }

        return $next($request);
    }
}
