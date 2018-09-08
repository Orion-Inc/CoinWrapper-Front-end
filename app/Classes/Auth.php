<?php
    namespace Crypto\Classes;

    use Crypto\Classes\Api as callApi;

    class Auth
    {
        public static function authenticate(array $args, $method, $endpoint)
        {
            $response = callApi::login($args, $method, $endpoint);
            if($response['success'] == true){
                $_SESSION['authorize'] = [
                    'authorize' => true
                ];
            }

            return $response;
        }

        public static function session()
        {
            if(isset($_SESSION['user'])){
                return $_SESSION['user'];
            }
        }

        public static function checkAuthorize()
        {
            return isset($_SESSION['authorize']);
        }

        public static function checkSession()
        {
            return isset($_SESSION['user']);
        }

        public function signout()
        {
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
            }
        }
    }