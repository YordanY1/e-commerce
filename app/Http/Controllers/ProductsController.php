<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

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
            ->with(['images', 'reviews']); // Eager load images

        // Handle search query
        if ($searchQuery = $request->query('query')) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'LIKE', "%{$searchQuery}%")
                  ->orWhereHas('attributes', function ($subQuery) use ($searchQuery) {
                      $subQuery->where('description', 'LIKE', "%{$searchQuery}%");
                  });
            });
        }

        // Category filter logic
        $categorySlug = $request->query('category');
        // \Log::info('Category Slug: ' . $categorySlug);

        $category = Category::where('slug', $categorySlug)->first();
        if ($category) {
            $categoryId = $category->id;
            // \Log::info('Category ID: ' . $categoryId);

            $query->whereHas('attributes', function ($query) use ($categoryId) {
                $query->whereJsonContains('categories', (string)$categoryId);
            });
        } else {
            // \Log::warning('Category not found for slug: ' . $categorySlug);
        }

        // Manufacturer filter logic
        $manufacturerId = $request->query('manufacturer');
        // \Log::info('Manufacturer ID: ' . $manufacturerId);

        if ($manufacturerId && $manufacturerId !== 'all') {
            $query->where('manufacturer_id', $manufacturerId);
        }

        // Price range filter logic
        $this->applyPriceFilter($query, $request->query('priceRange'));

        // Sorting logic
        $this->applySorting($query, $request->query('sorting'));

        // Check if 'all' products are requested
        if ($request->query('pagination') === 'all') {
            $products = $query->get(); // Retrieve all products without pagination
        } else {
            $pagination = $request->query('pagination', 100); // Default or requested pagination
            $products = $query->paginate($pagination);
        }

        // Check if the request is an AJAX call
        if ($request->ajax()) {
            // Return JSON response for AJAX request
            return response()->json([
                'html' => view('products.partials.product_list', compact('products'))->render()
            ]);
        }

        // Return the full view for non-AJAX requests
        return view('products.products', compact('products', 'categories', 'manufacturers'));
    }

    private function applyPriceFilter($query, $priceRange)
    {
        // \Log::info('Price Range: ' . $priceRange);

        switch ($priceRange) {
            case '0-50':
                $query->where('price_subquery.min_price', '<=', 50);
                // \Log::info('Applying price filter: 0-50');
                break;
            case '50-100':
                $query->whereBetween('price_subquery.min_price', [50, 100]);
                // \Log::info('Applying price filter: 50-100');
                break;
            case '100-200':
                $query->whereBetween('price_subquery.min_price', [100, 200]);
                // \Log::info('Applying price filter: 100-200');
                break;
            case '200+':
                $query->where('price_subquery.min_price', '>', 200);
                // \Log::info('Applying price filter: 200+');
                break;
        }
    }

    private function applySorting($query, $sorting)
    {
        switch ($sorting) {
            case 'popular':
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

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');
        session(['lastSearch' => $query]);
        $products = Product::where('name', 'LIKE', "%{$query}%")
                           ->orWhereHas('attributes', function ($subQuery) use ($query) {
                               $subQuery->where('description', 'LIKE', "%{$query}%");
                           })
                           ->limit(5) // Limit the results to 5
                           ->get();

        return response()->json([
            'html' => view('products.partials.search_dropdown', compact('products'))->render()
        ]);
    }

    public function showCategory($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->firstOrFail();
        $subcategories = $category->children;

        return view('products.category', compact('category', 'subcategories'));
    }
}
