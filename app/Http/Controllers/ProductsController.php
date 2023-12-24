<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        if ($categoryId) {
            $products = Product::whereHas('attributes', function ($query) use ($categoryId) {
                $query->whereJsonContains('categories', (string) $categoryId);
            })->with(['images', 'price'])->get();
        } else {
            $products = Product::with(['images', 'price'])->get();
        }
        // Return the products view with the products data
        return view('products.products', compact('products'));
    }
}
