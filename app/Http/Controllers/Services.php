<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Services extends Controller
{
    public function index()
    {
        return view('services.index');
    }
}
