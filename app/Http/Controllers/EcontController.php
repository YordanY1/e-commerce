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
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        // Start by constructing the entire label data
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
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'phones' => [$request->phone]
                ],
                'receiverAddress' => [
                    'city' => [
                        'country' => ['code3' => 'BGR'],
                        'name' => 'Русе',
                        'postCode' => '7010'
                    ],
                    'street' => 'Муткурова',
                    'num' => '84',
                    'other' => 'бл. 5, вх. А, ет. 6'
                ],
                'packCount' => 1,
                'shipmentType' => 'PACK',
                'weight' => 5,
                'shipmentDescription' => 'обувки',
                'holidayDeliveryDay' => 'workday'
            ],
            'mode' => 'validate'
        ];

        $response = $this->econtService->createLabel($data);
        \Log::info('Create Label Response:', ['response' => $response]);

        if (isset($response['error'])) {
            return back()->with('error', 'Failed to create label: ' . $response['error']);
        }

        return back()->with('success', 'Label created successfully!');
    }

}
