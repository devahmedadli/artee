<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayPalPayout
{
    public function createPayout(Request $request)
    {
        // PayPal API endpoint for sandbox environment
        $url = "https://api-m.sandbox.paypal.com/v1/payments/payouts";

        // Your PayPal access token
        $access_token = "YOUR_ACCESS_TOKEN";

        // Headers for the API request
        $headers = [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer $access_token",
            "PayPal-Request-Id" => "YOUR_UNIQUE_REQUEST_ID"
        ];

        // Payload for the payout
        $payload = [
            "sender_batch_header" => [
                "sender_batch_id" => "UNIQUE_BATCH_ID",
                "email_subject" => "You have a payment!",
                "email_message" => "You received a payment. Thanks for using our service!"
            ],
            "items" => [
                [
                    "recipient_type" => "EMAIL",
                    "amount" => [
                        "value" => "9.87",
                        "currency" => "USD"
                    ],
                    "sender_item_id" => "ITEM_1",
                    "recipient_wallet" => "PAYPAL",
                    "receiver" => "recipient1@example.com"
                ],
                [
                    "recipient_type" => "EMAIL",
                    "amount" => [
                        "value" => "112.34",
                        "currency" => "USD"
                    ],
                    "sender_item_id" => "ITEM_2",
                    "recipient_wallet" => "PAYPAL",
                    "receiver" => "recipient2@example.com"
                ]
            ]
        ];

        // Send the POST request to create the payout
        $response = Http::post($url, $headers, $payload);

        // Check the response
        if ($response->status() == 201) {
            $payout_batch = $response->json();
            echo "Payout created successfully!";
            echo "Payout Batch ID: " . $payout_batch['batch_header']['payout_batch_id'];
            echo "Batch Status: " . $payout_batch['batch_header']['batch_status'];
        } else {
            echo "Error creating payout: " . $response->status();
            echo $response->text();
        }
    }
}

