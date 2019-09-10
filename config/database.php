<?php
return [
    'default' => 'privatedb',
    'connections' => [
        'publicdb' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_PUBLIC'),
            'port'      => env('DB_PORT_PUBLIC'),
            'database'  => env('DB_DATABASE_PUBLIC'),
            'username'  => env('DB_USERNAME_PUBLIC'),
            'password'  => env('DB_PASSWORD_PUBLIC'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
        'privatedb' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_PRIVATE'),
            'port'      => env('DB_PORT_PRIVATE'),
            'database'  => env('DB_DATABASE_PRIVATE'),
            'username'  => env('DB_USERNAME_PRIVATE'),
            'password'  => env('DB_PASSWORD_PRIVATE'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
    ],
];
