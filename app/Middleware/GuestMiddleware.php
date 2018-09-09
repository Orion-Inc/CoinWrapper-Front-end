<?php
    namespace Swap\Middleware;

    class GuestMiddleware extends Middleware
    {
        public function __invoke($request, $response, $next)
        {
            if ($this->container->auth->checkSession()) {
                return $response->withRedirect($this->container->router->pathFor('app.dashboard'));
            }

            if ($this->container->auth->checkAuthorize()) {
                return $response->withRedirect($this->container->router->pathFor('auth.authorize'));
            }

            $response = $next($request, $response);
            
            return $response;
        }
    }