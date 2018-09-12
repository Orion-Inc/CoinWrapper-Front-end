<?php
    namespace Swap\ErrorHandler;

    class NotAllowedHandler extends Handler
    {
        public function __invoke($request, $response, $methods)
        {
            return $this->view->render($response, 'errors/405.twig', [
                'pageTitle' => '405 Not Found',
                'uri' => 'not-allowed-405',
                'bodyCSS' => 'swap-bg'
            ])->withStatus(405);
            // ->withHeader('Allow', implode(', ', $methods))
            // ->withHeader('Content-type', 'text/html')
            // ->write('Method must be one of: ' . implode(', ', $methods));
        }
    }