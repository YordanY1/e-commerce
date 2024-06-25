<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function store(Request $request)
    {
        Log::info("Client log: " . $request->input('message'));
        return response()->json(['status' => 'success']);
    }
}
