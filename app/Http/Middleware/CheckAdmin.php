<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class CheckAdmin {
    public function handle(Request $request, Closure $next) {
        // Check if the authenticated user has the admin role
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // If the user is not an admin, return a 403 Forbidden response
        return response()->json(['message' => 'Access forbidden: Admins only'], 403);
    }
}
