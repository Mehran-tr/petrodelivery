<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyAccess {
    public function handle(Request $request, Closure $next) {
        $userCompanyId = auth()->user()->company_id;

        // If route has a 'company_id' parameter, verify it matches the user's company_id
        if ($request->route('company_id') && $request->route('company_id') != $userCompanyId) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return $next($request);
    }
}
