<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Vite dev server jalan di origin terpisah (beda port) — hanya diizinkan saat local
        $viteDevSrc = '';
        if (app()->environment('local')) {
            $host = $request->getHost();
            $viteDevSrc = " http://{$host}:5173 https://{$host}:5173 ws://{$host}:5173 wss://{$host}:5173 http://localhost:5173 https://localhost:5173 ws://localhost:5173 wss://localhost:5173";
        }

        // 'unsafe-eval' wajib ada karena Alpine.js mengevaluasi x-data/x-on sebagai string JS
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'{$viteDevSrc}; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com{$viteDevSrc}; " .
            "img-src 'self' data: https:; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "connect-src 'self' https://fonts.googleapis.com https://fonts.gstatic.com{$viteDevSrc};"
        );

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
