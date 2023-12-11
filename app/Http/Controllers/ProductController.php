<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method to show a product's details
    public function index()
    {
        // For now, we'll just return a view
        return view('products.product_show');
    }

}
