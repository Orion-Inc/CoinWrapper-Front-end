<?php
    namespace Swap\Controllers;

    class AppController extends Controller
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'dashboard/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

        public function accountsettings($request, $response)
        {
            return $this->view->render($response, 'dashboard/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

        public function help($request, $response)
        {
            return $this->view->render($response, 'dashboard/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

    }
    