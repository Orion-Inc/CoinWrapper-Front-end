<?php
    namespace Swap\Controllers;

    use Swap\APIs\RatesApi as callApi;

    class RatesController extends Controller
    {
        public function getCoinRates($request, $response)
        {
            callApi::coinrates();
        }

        public function getExchangeRates($request, $response)
        {
            callApi::exchangerates($request->getParam('currency'));
        }
    }
    