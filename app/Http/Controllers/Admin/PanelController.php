<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PanelController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.panel');
    }
}
