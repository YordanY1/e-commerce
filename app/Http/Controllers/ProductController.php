<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method to show a single product's details
    public function show($id)
    {
        $product = Product::with(['images', 'price', 'attributes'])->findOrFail($id);
        return view('products.product_show', compact('product'));
    }
}
