<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=10.214.6.90)(PORT = 1521)))(CONNECT_DATA=(SERVICE_NAME=APPDB)))'),
        'host'           => env('DB_HOST', '10.214.6.90'),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', 'DZ_SHPENDI'),
        'service_name'   => env('DB_SERVICENAME', 'APPDB'),
        'username'       => env('DB_USERNAME', 'DZ_SHPENDI'),
        'password'       => env('DB_PASSWORD', 'DZ_SHPENDI1!'),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
        'dynamic'        => [],
    ],
];
