<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesApiController extends Controller
{
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
                $path = $request->file('image')->store('images', 'public');
                \Log::info('Image stored at path: ' . $path);
                $validatedData['image'] = $path;
            } else {
                \Log::info('No image found in request');
            }

            $category = Category::create($validatedData);
            \Log::info('Category created', $category->toArray());

            return response()->json($category, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ' . $e->getMessage());
            \Log::error('Validation errors: ', $e->errors());
            return response()->json(['error' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Error storing category: ' . $e->getMessage());
            \Log::error('Stack trace: ', $e->getTrace());

            return response()->json(['error' => 'An error occurred while storing the category'], 500);
        }
    }
}
