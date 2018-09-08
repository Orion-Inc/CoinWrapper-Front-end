<?php
    session_start();

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    use Respect\Validation\Validator as v;

    require __DIR__.'/../vendor/autoload.php';

    $app = new \Slim\App([
        'settings' => [
            'diplayErrorDetails' => true,
            'logger' => [
                'name' => 'slim-app',
                'level' => Monolog\Logger::DEBUG,
                'path' => __DIR__ . '/../logs/app.log',
            ],
        ]
    ]);

    $container = $app->getContainer();

    $container['view'] = function ($container){
        $view = new \Slim\Views\Twig(__DIR__.'/../resources/views', [
            'cache' => false
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router, $container->request->getUri()
        ));

        $view->getEnvironment()->addGlobal('user', [
            'checkSession' => $container->auth->checkSession(),
            'userSession' => $container->auth->session(),
        ]);

        $view->getEnvironment()->addGlobal('flash', $container->flash);

        return $view;
    };

    $container['flash'] = function () {
        return new \Slim\Flash\Messages();
    };

    $container['plugins'] = function ($container){
        
    };

    $container['auth'] = function ($container){
        return new \Crypto\Classes\Auth;
    };

    $container['api'] = function ($container){
        return new \Crypto\Classes\Api;
    };

    $container['csrf'] = function ($container){
        return new \Slim\Csrf\Guard;
    };

    $container['validator'] = function ($container){
        return new Crypto\Validation\Validator;
    };

    $container['WebController'] = function ($container){
        return new \Crypto\Controllers\WebController($container);
    };

    $container['AuthController'] = function ($container){
        return new \Crypto\Controllers\Auth\AuthController($container);
    };

    $container['AppController'] = function ($container){
        return new \Crypto\Controllers\AppController($container);
    };

    $app->add(new \Crypto\Middleware\ErrorsMiddleware($container));
    $app->add(new \Crypto\Middleware\KeepInputMiddleware($container));
    $app->add(new \Crypto\Middleware\CsrfMiddleware($container));

    $app->add($container->csrf);
    
    
    v::with('Crypto\\Validation\\Rules');

    require __DIR__.'/../routes/routes.php';