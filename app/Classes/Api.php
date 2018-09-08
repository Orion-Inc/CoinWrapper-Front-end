<?php
    namespace Crypto\Classes;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;

    class Api
    {
        private static $client = [
            'base_uri' => 'http://localhost:8080',
            'maxredirs' => 10,
            'timeout'  => 30,
            'Content-Type' => 'application/x-www-form-urlencoded',
            'x-access-token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiNWI4ZWJhNDE0OGRhNTA0MWRkN2MzMDlkIiwiaWF0IjoxNTM2MDk1NjY2LCJleHAiOjE1MzYwOTU5NjZ9.cvKFWRqPVNvznCMNJcPd3prwV0PSoT7_pznIPmi6VLU'
        ];

        private static function request($args = array(), $method, $endpoint)
        {
            $fields = http_build_query($args);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_PORT => "8080",
                CURLOPT_URL => self::$client['base_uri'].$endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => self::$client['maxredirs'],
                CURLOPT_TIMEOUT => self::$client['timeout'],
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
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
            return self::request($args, $method, $endpoint);
        }

        public function login(array $args, $method, $endpoint){
            return self::request($args, $method, $endpoint);
        }
    }