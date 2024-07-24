<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Configurar headers para arquivos CSS
        if ($request->is('assets/*.css')) {
            $response->headers->set('Content-Type', 'text/css; charset=UTF-8');
        }

        // Configurar headers para arquivos JS
        if ($request->is('assets/*.js')) {
            $response->headers->set('Content-Type', 'application/javascript; charset=UTF-8');
        }

        return $response;
    }
}
