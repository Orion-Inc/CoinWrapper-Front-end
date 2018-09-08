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
            'base_uri' => 'http://localhost:8080/all',
            'timeout'  => 2.0,
        ],
        'twig' => [
            'debug' => true
        ],
    ];