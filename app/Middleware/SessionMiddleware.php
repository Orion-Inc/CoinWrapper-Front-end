<?php
    namespace Swap\Middleware;

    class SessionMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            if(isset($_SESSION['user'])){
                $this->container->view->getEnvironment()->addGlobal('user', [
                    
                ]);
            }

            $response = $next($request, $response);
            
            return $response;
        }
    }