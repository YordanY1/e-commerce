<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::with(['manufacturer', 'attributes', 'images', 'price'])->get();
        $manufacturers = Manufacturer::all();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'manufacturers', 'categories'));
    }
}


