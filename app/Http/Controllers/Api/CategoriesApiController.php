<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoriesApiController extends Controller
{
    // List all categories
    public function index()
    {
        return Category::with('children')->get();
    }

    // Show a single category by ID
    public function show($id)
    {
        return Category::with('children')->findOrFail($id);
    }

    // Store a new category
    public function store(Request $request)
    {
        \Log::info('Store method called');

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            \Log::info('Validation passed', $validatedData);

            $validatedData['slug'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                \Log::info('Image found in request');
                $path = $request->file('image')->store('category_images', 'public');
                \Log::info('Image stored at path: ' . $path);
                $validatedData['image'] = $path;
            } else {
                \Log::info('No image found in request');
            }

            $category = Category::create($validatedData);
            \Log::info('Category created', $category->toArray());

            return response()->json($category, 201);
        } catch (\Exception $e) {
            \Log::error('Error storing category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the category'], 500);
        }
    }



    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'code' => 'string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $path = $request->file('image')->store('category_images', 'public');
            $validatedData['image'] = $path;
        }

        $category->update($validatedData);

        return response()->json($category);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
