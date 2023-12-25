<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::query()->with(['images', 'price']);

        // Category filter logic
        $categoryId = $request->query('category');
        if ($categoryId) {
            $query->whereHas('attributes', function ($query) use ($categoryId) {
                $query->whereJsonContains('categories', (string) $categoryId);
            });
        }

        // Price range filter logic
        $priceRange = $request->query('priceRange');
        switch ($priceRange) {
            case 'price-range-1':
                $query->whereHas('price', function($q) {
                    $q->where('price', '<=', 50);
                });
                break;
            case 'price-range-2':
                $query->whereHas('price', function($q) {
                    $q->whereBetween('price', [50, 100]);
                });
                break;
            case 'price-range-3':
                $query->whereHas('price', function($q) {
                    $q->whereBetween('price', [100, 200]);
                });
                break;
            case 'price-range-4':
                $query->whereHas('price', function($q) {
                    $q->where('price', '>', 200);
                });
                break;
        }

        $products = $query->get();

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            // Return JSON response for AJAX request
            return response()->json([
                'html' => view('products.partials.product_list', compact('products'))->render()
            ]);
        }

        // Return the full view for non-AJAX requests
        return view('products.products', compact('products', 'categories'));
    }
}
