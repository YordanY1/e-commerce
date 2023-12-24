<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); // Fetch all categories

        $categoryId = $request->query('category');

        if ($categoryId) {
            $products = Product::whereHas('attributes', function ($query) use ($categoryId) {
                $query->whereJsonContains('categories', (string) $categoryId);
            })->with(['images', 'price'])->get();
        } else {
            $products = Product::with(['images', 'price'])->get();
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('products.partials.product_list', compact('products'))->render()
            ]);
        }

        // Return the full view for non-AJAX requests
        return view('products.products', compact('products', 'categories'));

    }
}
