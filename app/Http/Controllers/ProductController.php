<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('category');
        if ($categoryId) {
            // Fetch products for the selected category
            $products = Product::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })->get();
        } else {
            // Fetch all products if no category is selected
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }
}
