<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SessionExpire
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
        $maxSessionTime = 7200;
        $lastActivity = $request->session()->get('lastActivityTime');
        $currentTime = time();

        if ($lastActivity && ($currentTime - $lastActivity > $maxSessionTime)) {
            // Clear the cart and other session data
            $request->session()->forget('cart');
            $request->session()->forget('lastActivityTime');
            Log::info('Session expired. Cart data cleared.', [
                'lastActivity' => $lastActivity,
                'currentTime' => $currentTime,
                'timeDifference' => $currentTime - $lastActivity
            ]);
        } else {
            // Update the last activity time
            $request->session()->put('lastActivityTime', $currentTime);
            Log::info('Session activity updated.', [
                'lastActivityTime' => $currentTime,
                'cart' => $request->session()->get('cart')
            ]);
        }

        return $next($request);
    }
}
