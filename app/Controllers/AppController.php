<?php
    namespace Crypto\Controllers;
    use Slim\Views\Twig as View;

    class AppController extends Controller
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'dashboard.twig', [
                'pageTitle' => 'Dashboard',
                'uri'=> 'dashboard'
            ]);
        }

    }
    