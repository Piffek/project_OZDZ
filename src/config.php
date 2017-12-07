<?php

return [
    'DEBUG' => 0,
    'LOGG_ERROR' => 1,
    'PATH' => __DIR__.'/../log.log',
    'google_plus' => [
        'client_id' => getenv('G_PLUS_ID'),
        'client_secret' => getenv('G_PLUS_KEY'),
        'api_key' =>  getenv('G_PLUS_KEY'),
        'redirect_url' => 'http://localhost:8000/gplusLogin',
        'application_name' => 'project_OZDZ',
    ],
];