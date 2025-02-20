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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'mail' => [
        'host' => env('CMAIL_HOST'),
        'port' => env('CMAIL_PORT'),
        'username' => env('CMAIL_USERNAME'),
        'password' => env('CMAIL_PASSWORD'),
        'encryption' => env('CMAIL_ENCRYPTION'),
        'from_address' => env('CMAIL_FROM_ADDRESS'),
        'from_name' => env('CMAIL_FROM_NAME'),

    ],

];
