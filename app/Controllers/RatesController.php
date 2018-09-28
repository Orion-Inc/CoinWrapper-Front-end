<?php
    namespace Swap\Controllers;

    use Swap\APIs\RateApi as callApi;

    class RatesController extends Controller
    {
        public function getRates($request, $response)
        {
            callApi::rates();
        }
    }
    