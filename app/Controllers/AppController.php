<?php
    namespace Swap\Controllers;

    class AppController extends Controller
    {
        public function dashboard($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

        public function buy($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Buy',
                'uri'=> 'buy'
            ]);
        }

        public function sell($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Sell',
                'uri'=> 'sell'
            ]);
        }

        public function trade($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Post Ad',
                'uri'=> 'trade'
            ]);
        }

        public function wallet($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Wallet',
                'uri'=> 'wallet'
            ]);
        }

        public function accountsettings($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Account Settings',
                'uri'=> 'account-settings'
            ]);
        }

        public function help($request, $response)
        {
            return $this->view->render($response, 'template/dashboard.twig', [
                'pageTitle' => 'Help',
                'uri'=> 'help'
            ]);
        }

    }
    