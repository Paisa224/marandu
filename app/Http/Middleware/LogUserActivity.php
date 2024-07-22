<?php

namespace app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            // Registrar la actividad del usuario
            Log::info('User Activity', [
                'user_id' => auth()->user()->id,
                'url' => $request->url(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
