<?php
    namespace Swap\Middleware;

    class AuthMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            if (!$this->container->auth->checkAuthorize()) {
                $this->container->flash->addMessage('message', 'Please sign in first.');
                return $response->withRedirect($this->container->router->pathFor('auth.sign-in'));
            }

            $response = $next($request, $response);
            
            return $response;
        }
    }