<?php
    return [
        'settings' => [
            'diplayErrorDetails' => false,
            'logger' => [
                'name' => 'slim-app',
                'level' => Monolog\Logger::DEBUG,
                'path' => __DIR__ . '/../logs/app.log',
            ],
        ],
        'app' => [
            'url' => '',
            'api' => [
                
            ],
        ],
        'authentication' => [
            
        ],
        'twig' => [
            'debug' => false
        ],
    ];