<?php
    namespace Swap\Classes;

    use Swap\Classes\Api as callApi;
    

    class Auth
    {
        public static function authorize(array $args, $method, $endpoint)
        {
            $response = callApi::login($args, $method, $endpoint);
        
            if($response['success'] == true){
                $authorize = $response['results'];
                $token = $response['meta']['token'];

                $_SESSION['authorize'] = [
                    'authorize' => true,
                    'email' => $authorize['email'],
                    'token' => $token
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

        public function signin($user)
        {
            print('<pre>'.print_r(@$user,true).'</pre>');
            print('<pre>'.print_r(@$_SESSION['authorize'],true).'</pre>');
            
            // if(!$this->checkAuthorize()){
            //     //return false;
            // }
            
            // $authSession = $_SESSION['authorize'];

            // if($authSession['email'] != $user['email']){
            //     //return false;
            // }

            

            die();
        }

        public function signout()
        {
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
            }
        }
    }