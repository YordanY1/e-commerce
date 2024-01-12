<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EcontService
{
    protected $client;
    protected $apiUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = config('app.env') === 'production' ?
                        config('econt.prod_api_url') :
                        config('econt.test_api_url');
        $this->username = config('econt.username');
        $this->password = config('econt.password');
    }

    public function createShipment($shipmentData)
    {
        try {
            $response = $this->client->request('POST', $this->apiUrl, [
                'auth' => [$this->username, $this->password],
                'headers' => ['Content-Type' => 'multipart/form-data'],
                'body' => $this->formatShipmentDataToXML($shipmentData)
            ]);

            return simplexml_load_string($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            // Handle the exception (log it, notify, etc.)
            throw $e;
        }
    }

    private function formatShipmentDataToXML($data)
    {
        $xml = new \SimpleXMLElement('<Shipment/>');

        foreach ($data as $key => $value) {
            $xml->addChild($key, $value);
        }

        return $xml->asXML();
    }

    public function getOffices()
    {
        $xmlRequest = $this->buildOfficesRequestXML();

        try {
            // Update the endpoint URL
            $endpoint = '/Nomenclatures/NomenclaturesService.getOffices.json';
            $url = $this->apiUrl . $endpoint;

            $response = $this->client->request('POST', $url, [
                'auth' => [$this->username, $this->password],
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $xmlRequest
            ]);

            // Debug: Print the raw response body
            echo $response->getBody();

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }



    private function buildOfficesRequestXML()
    {

        return [
            'client' => [
                'username' => $this->username,
                'password' => $this->password,
            ],
            'request_type' => 'offices',
        ];
    }

    public function fetchOffices()
{
    try {
        $offices = $this->econtService->getOffices();
        return response()->json(['success' => true, 'data' => $offices]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}


}
