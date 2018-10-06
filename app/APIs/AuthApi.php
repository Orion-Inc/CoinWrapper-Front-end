<?php
    namespace Swap\APIs;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;

    class AuthApi
    {
        private static $client = [
            'base_uri' => 'https://api-coin-wrapper.herokuapp.com',
            'maxredirs' => 10,
            'timeout'  => 30,
            'Content-Type' => 'application/x-www-form-urlencoded',
            'x-access-token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiNWI4ZWJhNDE0OGRhNTA0MWRkN2MzMDlkIiwiaWF0IjoxNTM2MDk1NjY2LCJleHAiOjE1MzYwOTU5NjZ9.cvKFWRqPVNvznCMNJcPd3prwV0PSoT7_pznIPmi6VLU'
        ];

        private static function request(array $args, $method, $endpoint, array $headers)
        {
            $fields = http_build_query($args);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                //CURLOPT_PORT => "8080",
                CURLOPT_URL => self::$client['base_uri'].$endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => self::$client['maxredirs'],
                CURLOPT_TIMEOUT => self::$client['timeout'],
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => $headers
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return json_decode($err,true);
            } else {
                return json_decode($response,true);
            }
        }

        public function newuser(array $args, $method, $endpoint){
            return self::request($args, $method, $endpoint, [
                "Content-Type: ".self::$client['Content-Type']
            ]);
        }

        public function login(array $args, $method, $endpoint){
            return self::request($args, $method, $endpoint, [
                "Content-Type: ".self::$client['Content-Type'],
                "x-access-token: ".self::$client['x-access-token']
            ]);
        }
    }