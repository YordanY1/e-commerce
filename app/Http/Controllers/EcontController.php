<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EcontService;
use Illuminate\Support\Facades\Log;

class EcontController extends Controller
{
    protected $econtService;

    public function __construct(EcontService $econtService)
    {
        $this->econtService = $econtService;
    }

    public function getOffices(Request $request)
    {
        $cityID = $request->input('cityID');
        $showCargoReceptions = $request->boolean('showCargoReceptions', false);
        $showLC = $request->boolean('showLC', false);

        $response = $this->econtService->getOffices($cityID, $showCargoReceptions, $showLC);
        return response()->json($response);
    }

        public function createLabel(Request $request)
    {
        Log::debug('Received label creation request:', $request->all());

        // Basic validation for all incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'delivery_method' => 'required|string',
            'city' => 'required_if:delivery_method,address|string|nullable',
            'postcode' => 'required_if:delivery_method,address|string|nullable',
            'street' => 'required_if:delivery_method,address|string|nullable',
            'num' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'description' => 'nullable|string',
            'weight' => 'required|numeric',
            'packCount' => 'required|integer'
        ]);

        // Prepare the label data according to the delivery method
        $receiverAddress = [];
        if ($request->delivery_method === 'address') {
            $receiverAddress = [
                'city' => [
                    'country' => ['code3' => 'BGR'],
                    'name' => $request->city,
                    'postCode' => $request->postcode
                ],
                'street' => $request->street,
                'num' => $request->num,
                'other' => $request->additional_info
            ];
        } else {
            // Default to a generic address or fetch from a predefined location
            $receiverAddress = [
                'city' => [
                    'country' => ['code3' => 'BGR'],
                    'name' => 'Русе',
                    'postCode' => '7010'
                ],
                'street' => 'Муткурова',
                'num' => '84',
                'other' => 'бл. 5, вх. А, ет. 6'
            ];
        }

        // Construct the entire label data
        $data = [
            'label' => [
                'senderClient' => [
                    'name' => 'Иван Иванов',
                    'phones' => ['0888888888']
                ],
                'senderAddress' => [
                    'city' => [
                        'country' => ['code3' => 'BGR'],
                        'name' => 'Русе',
                        'postCode' => '7012'
                    ],
                    'street' => 'Алея Младост',
                    'num' => '7'
                ],
                'receiverClient' => [
                    'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                    'phones' => [$validatedData['phone']]
                ],
                'receiverAddress' => $receiverAddress,
                'packCount' => $validatedData['packCount'],
                'shipmentType' => 'PACK',
                'weight' => $validatedData['weight'],
                'shipmentDescription' => $validatedData['description'],
                'holidayDeliveryDay' => 'workday'
            ],
            'requestCourierTimeFrom' => '9:50:00',
            'requestCourierTimeTo' => '20:00:00',
            'mode' => 'validate'
        ];

        $response = $this->econtService->createLabel($data);
        Log::info('Create Label Response:', ['response' => $response]);

        if (isset($response['error'])) {
            return back()->with('error', 'Failed to create label: ' . $response['error']);
        }

        return back()->with('success', 'Label created successfully!');
    }
}
