<?php
    namespace Crypto\Middleware;

    class KeepInputMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            if(isset($_SESSION['input'])){
                $this->container->view->getEnvironment()->addGlobal('input', $_SESSION['input']);
                $_SESSION['input'] = $request->getParams();
            }

            $response = $next($request, $response);
            
            return $response;
        }
    }