<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['price', 'images'])->get(); // If multiple images per product


        return view('home', compact('products'));
    }
}
