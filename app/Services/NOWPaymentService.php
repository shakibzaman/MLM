<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NOWPaymentService
{
    private $apiKey;
    private $url;

    public function __construct()
    {
        $this->apiKey = config('payment.nowpay.api_key');
        $this->url = config('payment.nowpay.url');
    }

    public function createInvoice(float $amount, string $orderId, string $description)
    {
        $client = new Client();

        try {
            $response = $client->post("{$this->url}/invoice", [
                'json' => [
                    'price_amount' => $amount,
                    'price_currency' => 'usd',
                    'order_id' => $orderId,
                    'order_description' => $description,
                    'success_url' => route('payment.success'),
                    'cancel_url' => route('payment.cancel'),
                ],
                'headers' => [
                    'x-api-key' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            // Handle the error as needed
            return [
                'error' => 'Could not create invoice: ' . $e->getMessage(),
            ];
        }
    }

    public function handleWebhook(array $data)
    {
        if ($data['payment_status'] == 'finished') {
            // Handle successful payment (e.g., update order status in the database)
            // Return true/false based on your logic
            return true;
        }

        return false;
    }
}
