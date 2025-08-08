<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRouteAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            Log::info('📍 Acceso a ruta', [
                'usuario_id' => auth()->user()->id,
                'usuario'    => auth()->user()->name,
                'ruta'       => $request->path(),
                'metodo'     => $request->method(),
                'ip'         => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
