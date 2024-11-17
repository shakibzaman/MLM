<?php

namespace App\Services;

use GuzzleHttp\Client;

class BTCPayService
{
    protected $client;
    protected $apiKey;
    protected $storeId;
    protected $btcpayUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('payment.btcpay.api_key'); // Store your API key in the config
        $this->storeId = config('payment.btcpay.store_id'); // Your Store ID
        $this->btcpayUrl = config('payment.btcpay.url'); // Your BTCPayServer URL
    }

    public function createInvoice($amount, $currency = 'USDT')
    {
        info('API key', [$this->apiKey]);
        info('storeId key', [$this->storeId]);
        info('btcpayUrl key', [$this->btcpayUrl]);
        $response = $this->client->post("{$this->btcpayUrl}/api/v1/stores/{$this->storeId}/invoices", [
            'headers' => [
                'Authorization' => "Bearer 8e91379fbb534181a44bcfb0320ffe8befa2532d",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'amount' => $amount,
                'currency' => $currency,
                'checkout' => [
                    'speedPolicy' => 'medium',
                ],
            ],
        ]);
        info('Response invoice is ', [$response]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
