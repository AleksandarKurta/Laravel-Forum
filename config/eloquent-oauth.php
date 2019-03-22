<?php

use App\User;

return [
    'model' => User::class,
    'table' => 'oauth_identities',
    'providers' => [
        'facebook' => [
            'client_id' => '273827493540911',
            'client_secret' => '94f090c999dec9b3c2ed13541e737d4e',
            'redirect_uri' => 'http://127.0.0.1:8000//facebook/redirect',
            'scope' => [],
        ],
        'google' => [
            'client_id' => '13591071385-ondj555786e6lh7dj0cm8tgm5snec8k0.apps.googleusercontent.com',
            'client_secret' => 'K1omwHP9SVFln2YOc8nonDUL',
            'redirect_uri' => 'http://127.0.0.1:8000//google/redirect',
            'scope' => [],
        ],
        'github' => [
            'client_id' => '77b80065d58afec4d3ef',
            'client_secret' => '7da1941c7e5c3cd453ea67b46ff7a9018829c3e6',
            'redirect_uri' => 'http://127.0.0.1:8000//github/redirect',
            'scope' => [],
        ],
        'linkedin' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
            'scope' => [],
        ],
        'instagram' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/instagram/redirect',
            'scope' => [],
        ],
        'soundcloud' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
            'scope' => [],
        ],
    ],
];
