<?php
    namespace Swap\Controllers;

    use Swap\Classes\RateApi as callApi;

    class RatesController extends Controller
    {
        public function getRates($request, $response)
        {
            callApi::rates();
        }
    }
    