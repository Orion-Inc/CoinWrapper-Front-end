<?php
    namespace Swap\Classes;

    use Swap\APIs\AuthApi as callApi;
    use Lcobucci\JWT\Parser;
    use Lcobucci\JWT\ValidationData;

    class Auth extends App
    {
        public static function authorize(array $args, $method, $endpoint)
        {
            $response = callApi::login($args, $method, $endpoint);
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
            if(!$this->checkAuthorize()){
                $this->flash->addMessage('message', 'Please Sign In Again.');
                return false;
            }
            
            $authSession = $_SESSION['authorize'];

            if($authSession['email'] != $user['email']){
                $this->unauthorize();
                $this->flash->addMessage('message', 'We Could Not Sign You Into Your Account. <br><small>Please check your email address.</small>');
                return false;
            }

            $userTokenObject = (new Parser())->parse($user['token']);
            $sessionTokenObject = (new Parser())->parse($authSession['token']);

            if($userTokenObject->getClaim('user_id') != $authSession['user_id']){
                $this->unauthorize();
                $this->flash->addMessage('message', 'We Could Not Sign You Into Your Account. <br><small>Token has expired!</small>');
                return false;
            }

            $data = new ValidationData();

            if($userTokenObject->validate($data)){
                $_SESSION['user'] = [
                    'authorize' => true,
                    'user_id' => $userTokenObject->getClaim('user_id'),
                    'first_name' => $userTokenObject->getClaim('firstname'),
                    'other_names' => $userTokenObject->getClaim('othername'),
                    'username' => $userTokenObject->getClaim('username'),
                    'email' => $userTokenObject->getClaim('email'),
                    'phone_number' => $userTokenObject->getClaim('phone_number')
                ];
            }else{
                $this->unauthorize();
                $this->flash->addMessage('message', 'Please Sign In Again.');
                return false;
            }

            return true;
        }

        public function unauthorize()
        {
            unset($_SESSION['authorize']);
        }

        public function signout()
        {
            unset($_SESSION['user']);
        }
    }