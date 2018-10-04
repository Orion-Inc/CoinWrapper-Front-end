<?php
    namespace Swap\APIs;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;

    class RatesApi
    {
        private static $client = [
            'coinmarketcap.api' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?',
            'cryptocompare.api' => 'https://min-api.cryptocompare.com/data/pricemultifull?',
            'currencyconverter.api' => 'https://free.currencyconverterapi.com/api/v5/convert?',
            'X-CMC_PRO_API_KEY' => '92048b13-fa65-4697-8850-251428af14af',
            'symbol' => 'BTC,ETH,LTC',
            'fsyms' => 'BTC,ETH,LTC',
            'convert' => 'GHC',
            'tsyms' => 'USD,GHS'
        ];

        private static function request($url, array $args, array $headers)
        {
            $fields = http_build_query($args);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url.$fields,
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

        public static function coinrates(){
            $rates = self::request(
                self::$client['cryptocompare.api'],
                [
                    "fsyms" => self::$client['fsyms'],
                    "tsyms" => self::$client['tsyms']
                ],
                []
            )['RAW'];
        
            $response = [
                'btc' => [
                    'coinname' => 'Bitcoin',
                    'priceusd' => $rates['BTC']['USD']['PRICE'],
                    'priceghs' => $rates['BTC']['GHS']['PRICE'],
                    'priceusdformatted' => number_format($rates['BTC']['USD']['PRICE'],2),
                    'priceghsformatted' => number_format($rates['BTC']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['BTC']['GHS']['CHANGEPCT24HOUR'],2)."%"
                ],
                'eth' => [
                    'coinname' => 'Ethereum',
                    'priceusd' => $rates['ETH']['USD']['PRICE'],
                    'priceghs' => $rates['ETH']['GHS']['PRICE'],
                    'priceusdformatted' => number_format($rates['ETH']['USD']['PRICE'],2),
                    'priceghsformatted' => number_format($rates['ETH']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['ETH']['GHS']['CHANGEPCT24HOUR'],2)."%"
                ],
                'ltc' => [
                    'coinname' => 'Litecoin',
                    'priceusd' => $rates['LTC']['USD']['PRICE'],
                    'priceghs' => $rates['LTC']['GHS']['PRICE'],
                    'priceusdformatted' => number_format($rates['LTC']['USD']['PRICE'],2),
                    'priceghsformatted' => number_format($rates['LTC']['GHS']['PRICE'],2),
                    'pctchange' => number_format((float)$rates['LTC']['GHS']['CHANGEPCT24HOUR'],2)."%"
                ]
            ];

            echo json_encode($response);
        }

        public static function exchangerates($from,$to){
            $currency = $from."_".$to;
            $rates = self::request(
                self::$client['currencyconverter.api'],
                [
                    "q" => $currency,
                    "compact" => "ultra"
                ],
                []
            );

            $response = [
                'rate' => number_format($rates[$currency],2)
            ];

            echo json_encode($response);
        }
    }