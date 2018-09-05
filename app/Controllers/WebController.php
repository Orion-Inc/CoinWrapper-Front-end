<?php
    namespace Crypto\Controllers;

    class WebController extends Controller
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'website/home.twig', [
                'pageTitle' => 'Home',
                'uri'=> 'home'
            ]);
        }

        public function aboutus($request, $response)
        {
            return $this->view->render($response, 'website/about-us.twig', [
                'pageTitle' => 'About Us',
                'uri'=> 'about-us'
            ]);
        }

        public function contactus($request, $response)
        {
            return $this->view->render($response, 'website/contact-us.twig', [
                'pageTitle' => 'Contact Us',
                'uri'=> 'contact-us'
            ]);
        }

        public function faqs($request, $response)
        {
            return $this->view->render($response, 'website/faqs.twig', [
                'pageTitle' => 'FAQs',
                'uri'=> 'faqs'
            ]);
        }

        public function listBuySell($request, $response)
        {
            return $this->view->render($response, 'website/buy-sell.twig', [
                'pageTitle' => 'Buy/Sell',
                'uri' => 'buy-sell',
                'pageTitleCss' => 'bold'
            ]);
        }
    }
    