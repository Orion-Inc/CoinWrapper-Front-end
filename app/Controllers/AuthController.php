<?php
    namespace Crypto\Controllers;
    use Slim\Views\Twig as View;

    class AuthController extends BaseController
    {
        public function signin($request, $response)
        {
            return $this->view->render($response, 'signin.twig', [
                'pageTitle' => 'Sign In',
                'uri'=> 'sign-in'
            ]);
        }

        public function signup($request, $response)
        {
            return $this->view->render($response, 'signup.twig', [
                'pageTitle' => 'Sign Up',
                'uri'=> 'sign-up'
            ]);
        }
    }
    