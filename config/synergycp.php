<?php

// config for Knownhost/SCP
return [
    /**
     * The base URL for the SynergyCP API. This should be a domain name. Do not include the protocol.
     * For example, "synergycp.example.com" is correct. "https://synergycp.example.com" is incorrect.
     */
    'host' => env('SCP_HOST'),

    /**
     * If you use SSL, you can omit it and it'll use the default. Otherwise set this to false
     */
    'use_ssl' => env('SCP_USE_SSL', true),

    /**
     * If you use SSL and have a self-signed certificate, then you can set this to false to disable SSL verification.
     */
    'ssl_verify' => env('SCP_SSL_VERIFY', true),

    /**
     * The authentication credentials for the SynergyCP API.
     */
    'auth' => [
        'api_key' => env('SCP_API_KEY'),
    ],
];
