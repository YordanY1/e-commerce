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
        Log::info('Access attempt from IP: ' . $request->ip());
        $allowedIps = [
            '192.168.0.100', // Local network IP
            '46.55.194.42',  // Your real public IP
            '127.0.0.1'      // Localhost, for development and testing
        ];

        if (!in_array($request->ip(), $allowedIps)) {
            Log::warning('Unauthorized attempt to access from IP: ' . $request->ip());
            return redirect('/'); // Redirects to the home page if IP is not allowed
        }

        return $next($request);
    }
}
