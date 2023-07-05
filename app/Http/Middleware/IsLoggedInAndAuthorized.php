<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoggedInAndAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->session()->has('user')) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Anda belum login, silakan login terlebih dahulu',
                    'error' => true
                ], 401);
            }
            return response()->redirectTo('/login');
        }

        $authorized = count($roles) === 0;
        $user = $request->session()->get('user');
        foreach ($roles as $role) {
            if (in_array(trim($role), $user['roles'])) {
                $authorized = true;
            }
        }

        if (!$authorized) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Anda tidak memiliki hak akses yg cukup',
                    'error' => true
                ], 403);
            }
            return response()->redirectTo('/dashboard');
        }

        return $next($request);
    }
}