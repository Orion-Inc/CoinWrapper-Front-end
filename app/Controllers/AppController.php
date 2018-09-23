<?php
    namespace Swap\Controllers;

    class AppController extends Controller
    {
        public function dashboard($request, $response)
        {
            return $this->view->render($response, 'app/dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

        public function buy($request, $response)
        {
            return $this->view->render($response, 'app/buy.twig', [
                'pageTitle' => 'Buy',
                'uri'=> 'buy'
            ]);
        }

        public function sell($request, $response)
        {
            return $this->view->render($response, 'app/sell.twig', [
                'pageTitle' => 'Sell',
                'uri'=> 'sell'
            ]);
        }

        public function trade($request, $response)
        {
            return $this->view->render($response, 'app/trade.twig', [
                'pageTitle' => 'Post Ad',
                'uri'=> 'trade'
            ]);
        }

        public function wallet($request, $response)
        {
            return $this->view->render($response, 'app/wallet.twig', [
                'pageTitle' => 'Wallet',
                'uri'=> 'wallet'
            ]);
        }

        public function accountsettings($request, $response)
        {
            return $this->view->render($response, 'app/account-settings.twig', [
                'pageTitle' => 'Account Settings',
                'uri'=> 'account-settings'
            ]);
        }

        public function help($request, $response)
        {
            return $this->view->render($response, 'app/help.twig', [
                'pageTitle' => 'Help',
                'uri'=> 'help'
            ]);
        }

    }
    