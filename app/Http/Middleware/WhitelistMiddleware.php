<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhitelistMiddleware
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
        // List of allowed IP addresses
        $allowedIps = ['46.55.194.42'];

        if (!in_array($request->ip(), $allowedIps)) {
            Log::warning('Unauthorized attempt to access admin area from IP: ' . $request->ip());

            // Abort the request with a 403 Forbidden or redirect
            return abort(403, 'Your IP address is not authorized to access this page.');
        }

        return $next($request);
    }
}
