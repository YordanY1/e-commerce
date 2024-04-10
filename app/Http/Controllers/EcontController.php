<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EcontService;

class EcontController extends Controller
{
    protected $econtService;

    public function __construct(EcontService $econtService)
    {
        $this->econtService = $econtService;
    }

    /**
     * Fetch and display a list of Econt offices.
     */
    public function fetchOffices()
    {
        $allOffices = $this->econtService->getOffices();
        $bgOffices = array_filter($allOffices['offices'], function ($office) {
            return $office['address']['city']['country']['code2'] === 'BG';
        });

        // Return only Bulgarian offices in the response
        return response()->json([
            'success' => true,
            'data' => array_values($bgOffices),
        ]);
    }

}
