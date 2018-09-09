<?php
    namespace Crypto\Classes;
    use Monolog;

    class Config
    {
        public static function configuration()
        {
            return [
                'settings' => [
                    'diplayErrorDetails' => true,
                    'logger' => [
                        'name' => 'Swap',
                        'level' => Monolog\Logger::DEBUG,
                        'path' => __DIR__ . '/../logs/app.log',
                    ],
                ],
            ];
        }
    }