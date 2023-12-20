<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use Illuminate\Http\Request;
use Validator;
use DB;

class ProductsApiController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with(['attributes', 'prices'])->get();
        return response()->json($products);
    }

    // Create a new product
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = DB::transaction(function () use ($request) {
            $product = Product::create($request->only(['name', 'code', 'manufacturer_id']));

            // Handle product attributes
            $attributes = new ProductAttribute($request->only(['size', 'weight', 'color', 'description']));
            $product->attributes()->save($attributes);

            // Handle prices
            $price = new Price($request->only(['price', 'cost', 'margin']));
            $product->prices()->save($price);

            // Handle categories
            $product->categories()->sync($request->categories);

            return $product;
        });

        return response()->json($product, 201);
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::with(['attributes', 'prices', 'categories'])->findOrFail($id);
        return response()->json($product);
    }

    // Update a specific product
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'code' => 'string|max:255',
            'manufacturer_id' => 'exists:manufacturers,id',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);
            $product->update($request->only(['name', 'code', 'manufacturer_id']));

            // Update product attributes
            $product->attributes()->update($request->only(['size', 'weight', 'color', 'description']));

            // Update prices
            $product->prices()->update($request->only(['price', 'cost', 'margin']));

            // Update categories
            if ($request->has('categories')) {
                $product->categories()->sync($request->categories);
            }

            return $product;
        });

        return response()->json($product);
    }

    // Delete a specific product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
