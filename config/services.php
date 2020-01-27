<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' =>[
        'client_id'=>'1054944704863892',
        'client_secret'=>'95f570c3c7de28c66585e56067572843',
        'redirect'=>'http://localhost:8000/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '936599653488-nvco9v8vgd4rjff51esle1ijdg37a55k.apps.googleusercontent.com',
        'client_secret' => 'F8KFulb57Uq322JpkzDHeas_',
        'redirect' => 'http://127.0.0.1:8000/login/google/callback',
    ],
];
