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
            \Log::info('Request data: ', $request->all());

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
            \Log::error('Stack trace: ', $e->getTrace());

            return response()->json(['error' => 'An error occurred while storing the category'], 500);
        }
    }

    // Update a category
    public function update(Request $request, $id)
    {
        \Log::info('Update method called for category ID: ' . $id);

        try {
            $category = Category::findOrFail($id);

            \Log::info('Category found', $category->toArray());

            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'code' => 'string|max:255',
                'parent_id' => 'nullable|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                \Log::info('New image found in request');
                // Delete the old image if it exists
                if ($category->image) {
                    \Log::info('Deleting old image: ' . $category->image);
                    Storage::disk('public')->delete($category->image);
                }

                $path = $request->file('image')->store('category_images', 'public');
                \Log::info('New image stored at path: ' . $path);
                $validatedData['image'] = $path;
            }

            $category->update($validatedData);

            \Log::info('Category updated', $category->toArray());

            return response()->json($category);
        } catch (\Exception $e) {
            \Log::error('Error updating category: ' . $e->getMessage());
            \Log::error('Stack trace: ', $e->getTrace());

            return response()->json(['error' => 'An error occurred while updating the category'], 500);
        }
    }

    // Delete a category
    public function destroy($id)
    {
        \Log::info('Destroy method called for category ID: ' . $id);

        try {
            $category = Category::findOrFail($id);
            $category->delete();

            \Log::info('Category deleted', ['id' => $id]);

            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Exception $e) {
            \Log::error('Error deleting category: ' . $e->getMessage());
            \Log::error('Stack trace: ', $e->getTrace());

            return response()->json(['error' => 'An error occurred while deleting the category'], 500);
        }
    }
}
