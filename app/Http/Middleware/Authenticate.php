<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ], 401);
        }

        return $next($request);
    }
}
