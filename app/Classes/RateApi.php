<?php
    namespace Swap\Classes;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;

    class RateApi
    {
        private static $client = [
            'coinmarketcap.api' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?',
            'cryptocompare.api' => 'https://min-api.cryptocompare.com/data/pricemultifull?',
            'X-CMC_PRO_API_KEY' => '92048b13-fa65-4697-8850-251428af14af',
            'symbol' => 'BTC,ETH,LTC',
            'fsyms' => 'BTC,ETH,LTC',
            'convert' => 'GHC',
            'tsyms' => 'GHS'
        ];

        private static function request(array $args, array $headers)
        {
            $fields = http_build_query($args);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => self::$client['cryptocompare.api'].$fields,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => $headers,
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

        public static function rates(){
            $rates = self::request(
                [
                    "fsyms" => self::$client['fsyms'],
                    "tsyms" => self::$client['tsyms']
                ],
                []
            )['RAW'];
        
            $response = [
                'btc' => [
                    'price' => number_format($rates['BTC']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['BTC']['GHS']['CHANGEPCT24HOUR'],2)
                ],
                'eth' => [
                    'price' => number_format($rates['ETH']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['ETH']['GHS']['CHANGEPCT24HOUR'],2)
                ],
                'ltc' => [
                    'price' => number_format($rates['LTC']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['LTC']['GHS']['CHANGEPCT24HOUR'],2)
                ]
            ];

            echo json_encode($response);
        }
    }