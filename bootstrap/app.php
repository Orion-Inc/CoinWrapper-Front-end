<?php
    session_start();

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Respect\Validation\Validator as v;
    use Swap\Classes\Config as get;


    require __DIR__.'/../vendor/autoload.php';

    $mode = file_get_contents(__DIR__.'/../configuration');

    $app = new \Slim\App(get::configuration($mode));

    $container = $app->getContainer();
    $settings = $container->get('settings')['logger'];
    $app_config = $container->get('app');

    $container['view'] = function ($container) use ($app_config){
        $view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
            'cache' => false
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router, $container->request->getUri()
        ));

        $view->getEnvironment()->addGlobal('app', $app_config);

        $view->getEnvironment()->addGlobal('user', [
            'checkAuthorize' => $container->auth->checkAuthorize(),
            'checkSession' => $container->auth->checkSession(),
            'userSession' => $container->auth->session(),
        ]);

        $view->getEnvironment()->addGlobal('flash', $container->flash);

        return $view;
    };

    $container['logger'] = function ($container){
        $logger = new \Monolog\Logger($settings['name']);
        $file_handler = new \Monolog\Handler\StreamHandler($settings['path']);
        $logger->pushHandler($file_handler);
        return $logger;
    };

    $container['notFoundHandler'] = function ($container){
        return new \Swap\ErrorHandler\NotFoundHandler($container);
    };

    $container['notAllowedHandler'] = function ($container){
        return new \Swap\ErrorHandler\NotAllowedHandler($container);
    };

    $container['flash'] = function () {
        return new \Slim\Flash\Messages();
    };

    $container['plugins'] = function ($container){
        
    };

    $container['auth'] = function ($container){
        return new \Swap\Classes\Auth($container);
    };

    $container['api'] = function ($container){
        return new \Swap\Classes\Api;
    };

    $container['csrf'] = function ($container){
        return new \Slim\Csrf\Guard;
    };

    $container['validator'] = function ($container){
        return new Swap\Validation\Validator;
    };

    $container['WebController'] = function ($container){
        return new \Swap\Controllers\WebController($container);
    };

    $container['AuthController'] = function ($container){
        return new \Swap\Controllers\Auth\AuthController($container);
    };

    $container['AppController'] = function ($container){
        return new \Swap\Controllers\AppController($container);
    };

    $container['ErrorsController'] = function ($container){
        return new \Swap\Controllers\Errors\ErrorsController($container);
    };

    $app->add(new \Swap\Middleware\ErrorsMiddleware($container));
    $app->add(new \Swap\Middleware\KeepInputMiddleware($container));
    $app->add(new \Swap\Middleware\CsrfMiddleware($container));

    $app->add($container->csrf);
    
    
    v::with('Swap\\Validation\\Rules');

    require __DIR__.'/../routes/routes.php';