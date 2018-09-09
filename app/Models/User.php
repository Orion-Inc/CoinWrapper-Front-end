<?php
    namespace Swap\Models;

    use Swap\Classes\Api as callApi;

    class User
    {
        public static function create(array $args, $method, $endpoint)
        {
            $response = callApi::newuser($args, $method, $endpoint);
            if($response['success'] == true){
                $_SESSION['authorize'] = [
                    'authorize' => true
                ];
            }

            return $response;
        }

        
    }
    