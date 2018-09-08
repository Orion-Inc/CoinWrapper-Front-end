<?php
    namespace Crypto\Models;

    use Crypto\Classes\Api as callApi;

    class User
    {
        public static function create(array $args, $method, $endpoint)
        {
            $response = callApi::newuser($args, $method, $endpoint);
            return $response;
        }

        
    }
    