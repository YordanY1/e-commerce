<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturersController extends Controller
{
    // Метод за показване на всички производители
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('manufacturers.index', compact('manufacturers'));
    }

    // Метод за показване на продуктите на конкретен производител
    public function show($slug)
    {
        $manufacturer = Manufacturer::where('slug', $slug)->firstOrFail();
        return redirect('/products?manufacturer=' . $manufacturer->slug);
    }
}
