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

        // Subquery for the lowest price for each product
        $priceSubQuery = \DB::table('prices')
            ->selectRaw('MIN(price) as min_price, product_id')
            ->groupBy('product_id');

        // Base query for products
        $query = Product::query()
            ->select('products.*', 'price_subquery.min_price')
            ->joinSub($priceSubQuery, 'price_subquery', function ($join) {
                $join->on('products.id', '=', 'price_subquery.product_id');
            })
            ->with(['images']); // Eager load images

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
                $query->where('price_subquery.min_price', '<=', 50);
                break;
            case 'price-range-2':
                $query->whereBetween('price_subquery.min_price', [50, 100]);
                break;
            case 'price-range-3':
                $query->whereBetween('price_subquery.min_price', [100, 200]);
                break;
            case 'price-range-4':
                $query->where('price_subquery.min_price', '>', 200);
                break;
        }

        // Sorting logic
        $sorting = $request->query('sorting');
        if ($sorting) {
            switch ($sorting) {
                case 'popular':
                    // Replace 'popularity' with an existing column in your 'products' table
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'expensive':
                    $query->orderBy('price_subquery.min_price', 'desc');
                    break;
                case 'low-price':
                    $query->orderBy('price_subquery.min_price', 'asc');
                    break;
            }
        }


        // Pagination logic
        $pagination = $request->query('pagination') ?: 10; // Default pagination
        $products = $query->paginate($pagination);

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
