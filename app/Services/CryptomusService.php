<?php

namespace App\Services;

use GuzzleHttp\Client;

class CryptomusService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('payment.cryptomus.api_key'); // Only the API Key
        $this->baseUrl = 'https://api.cryptomus.com'; // Cryptomus API base URL
    }

    // Create a payment invoice
    public function createPayment($amount, $currency = 'USDT')
    {
        info('Cryptomus API key', [$this->apiKey]);
        $url = $this->baseUrl . '/payment';
        $params = [
            'amount' => $amount,
            'currency' => $currency,
            'order_id' => uniqid(),
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
        ];

        $response = $this->sendRequest('POST', $url, $params);
        return json_decode($response->getBody(), true);
    }

    // Send requests to Cryptomus API
    protected function sendRequest($method, $url, $params)
    {
        return $this->client->request($method, $url, [
            'headers' => [
                'API-KEY' => $this->apiKey, // Only API key is needed here
            ],
            'json' => $params,
        ]);
    }
}
