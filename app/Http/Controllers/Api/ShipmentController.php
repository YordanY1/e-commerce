<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EcontService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    protected $econtService;

    public function __construct(EcontService $econtService)
    {
        $this->econtService = $econtService;
    }

    public function createShipment(Request $request)
    {
        // Validate and process $request data here...
        $validatedData = $request->validate([
            'recipient_name' => 'required|string',
            'delivery_method' => 'required|string',
            'city' => 'required_if:delivery_method,addressDelivery|string',
            'region' => 'required_if:delivery_method,addressDelivery|string',
            'address' => 'required_if:delivery_method,addressDelivery|string',
        ]);

        try {
            // Here, format the validated data as needed for the EcontService
            $response = $this->econtService->createShipment($validatedData);

            // Handle the response...
            return response()->json([
                'success' => true,
                'message' => 'Shipment created successfully',
                'data' => $response
            ]);

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'success' => false,
                'message' => 'Error creating shipment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOffices()
    {
        try {
            $offices = $this->econtService->getOffices();
            return response()->json($offices);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
