<?php
    namespace Swap\Middleware;

    class DashboardMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            if (!$this->container->auth->checkSession()) {
                $this->container->flash->addMessage('message', 'Please sign in first.');
                return $response->withRedirect($this->container->router->pathFor('auth.sign-in'));
            }

            $response = $next($request, $response);
            
            return $response;
        }
    }

