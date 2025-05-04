<?php

return [
    'default' => 'default',

    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'TuMobilya-API',
            ],
            'routes' => [
                'api' => 'api/documentation',
            ],
            'paths' => [
                'docs' => storage_path('api-docs'),
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'api-docs.yaml',
                'annotations' => [
                    base_path('app/Http/Controllers'),
                ],
                'base' => env('L5_SWAGGER_BASE_PATH', 'http://tumobilya-api.test'),
            ],
        ],
    ],

    'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', true),
    'swagger_version' => env('SWAGGER_VERSION', '3.0'),
    'persist_authorization' => env('L5_SWAGGER_PERSIST_AUTHORIZATION', false),

    'security' => [
        'sanctum' => [
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT',
        ],
    ],
];
