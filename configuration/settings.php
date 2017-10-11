<?php
return [
    'settings' => [
        'displayErrorDetails' => ('true' === getenv('DEBUG_DETAIL')), // set to false in production
        'service_directories' => [
            'services'    => APP_ROOT.'/configuration/services/',
            'middlewares' => APP_ROOT.'/configuration/middleware/',
            'routes'      => APP_ROOT.'/configuration/routes/',
        ], 

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'db' => [
            'driver'      => 'sqlite', //
            //'driver'    => 'mysql',            
            'database'    => __DIR__.'/../migrations/database.sqlite',
            //'database'  => 'database',
            //'host'      => 'localhost',
            //'username'  => 'user',
            //'password'  => 'password',
            'charset'     => 'utf8',
            'collation'   => 'utf8_unicode_ci',
            'prefix'      => '',
        ]
    ],
];
