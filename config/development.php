<?php
    return [
        'settings' => [
            'diplayErrorDetails' => true,
            'logger' => [
                'name' => 'slim-app',
                'level' => Monolog\Logger::DEBUG,
                'path' => __DIR__ . '/../logs/app.log',
            ],
        ],
        'app' => [
            'url' => 'http://app100.localhost/CoinWrapper-Front-end/public/'
        ],
        'api' => [
            'url' => 'http://localhost:8080/all'
        ],
        'twig' => [
            'debug' => true
        ],
    ];