<?php

    namespace Crypto\Controllers\Errors;

    use Crypto\Controllers\Controller;

    class ErrorsController extends Controller
    {
        public function notFound404($request, $response)
        {
            return $this->view->render($response, 'errors/404.twig', [
                'pageTitle' => 'Not Found',
                'uri'=> 'not-found-404'
            ]);
        }
    }
    