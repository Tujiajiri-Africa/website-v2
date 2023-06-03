<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Postmark credentials
    |--------------------------------------------------------------------------
    |
    | Here you may provide your Postmark server API token.
    |
    */

    'token' => env('POSTMARK_TOKEN'),
    'secret' => env('POSTMARK_SECRET'),
    'welcome_template_id' => env('POSTMARK_WELCOME_TEMPLATE_ID'),

    /*
    |--------------------------------------------------------------------------
    | Guzzle options
    |--------------------------------------------------------------------------
    |
    | Under the hood we use Guzzle to make API calls to Postmark.
    | Here you may provide any request options for Guzzle.
    |
    */

    'guzzle' => [
        'base_uri' => env('POSTMARK_BASE_URI', 'https://api.postmarkapp.com'),
        'timeout' => 10,
        'connect_timeout' => 10,
    ],
];
