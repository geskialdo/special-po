<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoggedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('user')) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Anda sudah login, harap logout terlebih dahulu atau muat ulang halaman anda',
                    'error' => true
                ], 403);
            }
            return response()->redirectTo('/dashboard');
        }
        return $next($request);
    }
}