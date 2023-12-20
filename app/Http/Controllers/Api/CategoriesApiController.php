<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesApiController extends Controller
{
    // List all categories
    public function index()
    {
        return Category::all();
    }

    // Show a single category by ID
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    // Store a new category
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'code' => 'required|string|max:255',
            // 'parent_id' => 'sometimes|nullable|integer|exists:categories,id',
            'description' => 'sometimes|string',
            // 'keywords' => 'sometimes|string',
            // 'status' => 'required|integer',
            // Add other fields as necessary
        ]);

        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }

    // Update a category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            // 'slug' => 'string|max:255|unique:categories,slug,' . $category->id,
            'code' => 'string|max:255',
            // 'parent_id' => 'nullable|integer|exists:categories,id',
            // 'description' => 'sometimes|string',
            // 'keywords' => 'sometimes|string',
            // 'status' => 'integer',
            // Add other fields as necessary
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
