<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use DB;

class ProductsApiController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with(['attributes', 'price'])->get();
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
            'image' => 'required|image|max:2048', // Validate the image
            'files.*' => 'file|max:2048', // Validate each file
            // Other attribute validations...
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = DB::transaction(function () use ($request) {
            $productData = $request->only(['name', 'code', 'manufacturer_id']);
            $productData['slug'] = Str::slug($request->name);
            $product = Product::create($productData);

            // Handle product attributes including categories
            $attributes = new ProductAttribute([
                'size' => $request->size,
                'weight' => $request->weight,
                'color' => $request->color,
                'description' => $request->description,
                'categories' => $request->categories, // Storing categories as JSON
                // Additional attributes...
            ]);
            $product->attributes()->save($attributes);

            // Handle prices
            $price = new Price($request->only(['price', 'cost', 'margin']));
            $product->price()->save($price);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('images', 'public'); // Storing in the 'public' disk

                $product->images()->create([
                    'name' => $image->getClientOriginalName(),
                    'path' => $path,
                    'extension' => $image->getClientOriginalExtension(),
                    'size' => $image->getSize(),
                    'width' => getimagesize($image)[0],
                    'height' => getimagesize($image)[1],
                    // Other fields...
                ]);
            }

            // Handle file uploads
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $filePath = $file->store('files', 'public');

                    $product->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $filePath,
                        'extension' => $file->getClientOriginalExtension(),
                        'size' => $file->getSize(),
                        'type' => $file->getMimeType(),
                        // Other fields...
                    ]);
                }
            }

            return $product;
        });

        return response()->json($product, 201);
    }


    // Show a specific product
    public function show($id)
    {
        $product = Product::with(['attributes', 'price', 'images', 'files'])->findOrFail($id);
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
                // Additional validations for other fields as needed...
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $product = DB::transaction(function () use ($request, $id) {
                $product = Product::findOrFail($id);
                $product->update($request->only(['name', 'code', 'manufacturer_id']));

                // Update product attributes including categories
                $attributesData = [
                    'size' => $request->size,
                    'weight' => $request->weight,
                    'color' => $request->color,
                    'description' => $request->description,
                    'categories' => $request->categories, // Assuming categories are stored as JSON
                ];
                $product->attributes()->update($attributesData);

                // Update prices
                $priceData = $request->only(['price', 'cost', 'margin']);
                if ($product->price) {
                    // Update existing price
                    $product->price->update($priceData);
                } else {
                    // Create new price if it doesn't exist
                    $product->price()->create($priceData);
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

        return response()->json(['message' => 'Product deleted successfully']);
    }

}
