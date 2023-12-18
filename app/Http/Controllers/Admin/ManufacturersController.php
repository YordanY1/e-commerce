<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;


class ManufacturersController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::paginate(30); // Or any other appropriate logic
        return view('admin.manufacturers.index', compact('manufacturers'));
    }
}
