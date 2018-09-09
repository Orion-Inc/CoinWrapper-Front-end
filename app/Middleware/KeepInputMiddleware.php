<?php
    namespace Swap\Middleware;

    class KeepInputMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            $this->container->view->getEnvironment()->addGlobal('input', @$_SESSION['input']);
            $_SESSION['input'] = $request->getParams();

            $response = $next($request, $response);
            
            return $response;
        }
    }