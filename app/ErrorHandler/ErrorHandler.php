<?php
    namespace Swap\ErrorHandler;

    class ErrorHandler 
    {
        public function __invoke($request, $response)
        {
            return $this->view->render($response, 'errors/404.twig', [
                'pageTitle' => '404 Not Found',
                'uri' => 'not-found-404',
                'bodyCSS' => 'swap-bg'
            ])->withStatus(404);
        }
    }
    