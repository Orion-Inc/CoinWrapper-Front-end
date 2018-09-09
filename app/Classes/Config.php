<?php
    namespace Crypto\Classes;
    use Monolog;

    define('ROOT', __DIR__.'/../../config/');

    class Config
    {
        public static function configuration($mode)
        {
            //return file_get_contents(ROOT.$mode.'.json');

            return [
                'settings' => [
                    'diplayErrorDetails' => true,
                    'logger' => [
                        'name' => 'Swap',
                        'level' => Monolog\Logger::DEBUG,
                        'path' => __DIR__ . '/../logs/app.log',
                    ],
                ],
                'app' => [
                    'name' => 'Swap',
                    'url' => 'http://app100.localhost/CoinWrapper-Front-end/public'
                ],
                'api' => [
                    'base_uri' => 'http://localhost:8080',
                    'timeout'  => 2.0,
                ],
                'twig' => [
                    'debug' => true
                ],
            ];
        }
    }