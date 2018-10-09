<?php
    namespace Swap\Models;

    use Swap\APIs\AuthApi as callApi;

    class User
    {
        public static function create(array $args, $method, $endpoint)
        {
            $response = callApi::newuser($args, $method, $endpoint);
            if($response['success'] == true){
                $authorize = $response['results'];
                $token = $response['meta']['token'];

                $_SESSION['authorize'] = [
                    'authorize' => true,
                    'user_id' => $authorize['_id'],
                    'email' => $authorize['email'],
                    'token' => $token
                ];
            }

            return $response;
        }

        
    }
    