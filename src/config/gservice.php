<?php
return [
    'client_id' => env('client_id'),
    'client_secret' => env('client_secret'),
    'grant_type' => env('grant_type'),
    'scope' => env('scope'),
    'api_endpoints' => [
        'auth' => env('auth_api'),
        'quotes' => env('quotes_api'),
        'delivery' => env('delivery_api'),
        'delivery_info' =>  env('delivery_info_api'),
        'cancel_delivery' => env('url_cancel_delivery_api'),
        'tracking_webhook' => env('tracking_webhook_api'),
        'grab_api_endpoint' => env('grab_api_endpoint'),
    ],
];
