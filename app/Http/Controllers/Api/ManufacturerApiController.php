<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerApiController extends Controller
{
    // List all manufacturers
    public function index()
    {
        return Manufacturer::all();
    }

    // Show a single manufacturer by ID
    public function show($id)
    {
        return Manufacturer::findOrFail($id);
    }

    // Store a new manufacturer
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255|unique:manufacturers',
            'code' => 'required|string|max:255',
            // 'country_id' => 'required|integer|exists:countries,id', // Assuming you have a countries table
            // 'status' => 'required|integer',
            // 'sort_order' => 'sometimes|integer',
        ]);

        $manufacturer = Manufacturer::create($validatedData);
        return response()->json($manufacturer, 201);
    }

    // Update a manufacturer
    public function update(Request $request, $id)
    {
        // Find the manufacturer
        $manufacturer = Manufacturer::findOrFail($id);

        // Update manufacturer details
        $manufacturer->name = $request->name;
        $manufacturer->slug = $request->slug;
        $manufacturer->code = $request->code;
        // Update other attributes as necessary

        // Save the changes
        $manufacturer->save();

        // Return a response, e.g., the updated manufacturer or a success message
        return response()->json($manufacturer);
    }


    // Delete a manufacturer
    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();

        // Return a response, such as a success message or status
        return response()->json(['message' => 'Manufacturer deleted successfully']);
    }

}
