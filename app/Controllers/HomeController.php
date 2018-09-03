<?php
    namespace Crypto\Controllers;
    use Slim\Views\Twig as View;

    class HomeController extends BaseController
    {
        public function index($request, $response)
        {
            return $this->view->render($response, 'home.twig');
        }
    }
    