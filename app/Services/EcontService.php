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
        $xml = $this->formatShipmentDataToXML($shipmentData);
        try {
            $response = $this->client->request('POST', $this->apiUrl, [
                'auth' => [$this->username, $this->password],
                'headers' => ['Content-Type' => 'multipart/form-data'],
                'body' => $xml
            ]);
            return simplexml_load_string($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    private function formatShipmentDataToXML($data)
    {
        $xml = new \SimpleXMLElement('<ShipmentRequest/>');
        $recipient = $xml->addChild('recipient');
        $recipient->addChild('name', $data['recipient_name']);
        $shipment = $xml->addChild('shipment');
        $shipment->addChild('delivery_method', $data['delivery_method']);

        if ($data['delivery_method'] === 'addressDelivery') {
            $address = $shipment->addChild('address');
            $address->addChild('city', $data['city']);
            $address->addChild('region', $data['region']);
            $address->addChild('street', $data['address']);
        } elseif ($data['delivery_method'] === 'ekontOffice') {
            $shipment->addChild('office_id', $data['selected_office_id']);
        }

        return $xml->asXML();
    }

    public function getOffices()
    {
        $request = $this->buildOfficesRequestJSON();
        try {
            $endpoint = '/Nomenclatures/NomenclaturesService.getOffices.json';
            $url = $this->apiUrl . $endpoint;
            $response = $this->client->request('POST', $url, [
                'auth' => [$this->username, $this->password],
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $request
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    private function buildOfficesRequestJSON()
    {
        return [
            'client' => [
                'username' => $this->username,
                'password' => $this->password,
            ],
            'request_type' => 'offices',
        ];
    }
}
