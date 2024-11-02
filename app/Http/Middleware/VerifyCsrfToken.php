<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*',
    ];

    protected function tokensMatch($request)
    {
        $sessionToken = $request->session()->token();
        $headerToken = $request->header('X-XSRF-TOKEN');

        \Log::info('Session CSRF Token: ' . $sessionToken);
        \Log::info('Header CSRF Token: ' . $headerToken);

        return parent::tokensMatch($request);
    }
}
