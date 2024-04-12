<?php

namespace App\Services;

use GuzzleHttp\Client;

class EcontService
{
    protected $client;
    protected $apiUrl;

    public function __construct($demo = false)
    {
        $this->apiUrl = $demo ? config('econt.demo_url') : config('econt.production_url');
        $this->client = new Client([
            'base_uri' => $this->apiUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function getOffices($cityID = null, $showCargoReceptions = false, $showLC = false)
    {
        $body = [
            'countryCode' => 'BGR',
            'cityID' => $cityID,
            'showCargoReceptions' => $showCargoReceptions,
            'showLC' => $showLC
        ];

        $body = array_filter($body, function($value) { return $value !== null; });

        try {
            $response = $this->client->post('Nomenclatures/NomenclaturesService.getOffices.json', [
                'json' => $body
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createLabel(array $data)
    {
        \Log::info('Sending data to Econt API:', $data);

        try {
            $response = $this->client->post('Shipments/LabelService.createLabel.json', [
                'json' => $data
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


}
