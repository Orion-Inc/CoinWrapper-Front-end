<?php
    namespace Crypto\Controllers;

    class AppController extends Controller
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'dashboard/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

    }
    