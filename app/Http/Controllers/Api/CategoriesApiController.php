<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $validatedData['slug'] = Str::slug($request->name);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'code' => 'string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

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
