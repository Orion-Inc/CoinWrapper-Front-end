<?php
    namespace Crypto\Controllers;
    use Slim\Views\Twig as View;

    class WebController extends Controller
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'home.twig', [
                'pageTitle' => 'Home',
                'uri'=> 'home'
            ]);
        }

        public function aboutus($request, $response)
        {
            return $this->view->render($response, 'about-us.twig', [
                'pageTitle' => 'About Us',
                'uri'=> 'about-us'
            ]);
        }

        public function contactus($request, $response)
        {
            return $this->view->render($response, 'contact-us.twig', [
                'pageTitle' => 'Contact Us',
                'uri'=> 'contact-us'
            ]);
        }

        public function faqs($request, $response)
        {
            return $this->view->render($response, 'faqs.twig', [
                'pageTitle' => 'FAQs',
                'uri'=> 'faqs'
            ]);
        }

        public function listBuySell($request, $response)
        {
            return $this->view->render($response, 'buy-sell.twig', [
                'pageTitle' => 'Buy/Sell',
                'uri' => 'buy-sell',
                'pageTitleCss' => 'bold'
            ]);
        }
    }
    