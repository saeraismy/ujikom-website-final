<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorsMiddleware
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
        // Menambahkan header CORS
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:65229'); // Ganti '*' dengan domain yang spesifik jika perlu
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        // Jika metode request adalah OPTIONS (pre-flight request), langsung beri response kosong
        if ($request->getMethod() == 'OPTIONS') {
            return response()->json([], 200);
        }

        return $response;
    }
}
