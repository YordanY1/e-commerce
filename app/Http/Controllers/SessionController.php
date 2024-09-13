<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function deleteSession(Request $request)
    {
        $sessionId = $request->input('sessionId');
        // Log::info("Received request to delete session: $sessionId");

        // Изтриване на сесията
        Session::getHandler()->destroy($sessionId);
        // Log::info("Session deleted: $sessionId");

        // Изтриване на количката
        if ($request->session()->has('cart')) {
            $request->session()->forget('cart');
            // Log::info("Cart deleted for session: $sessionId");
        }

        return response()->json(['status' => 'success']);
    }
}
