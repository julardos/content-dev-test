<?php

return [
    'mercant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    'is_production' => true,
    'is_sanitized' => false,
    'is_3ds' => false,
];
