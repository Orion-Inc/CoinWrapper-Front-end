<?php
    session_start();
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require __DIR__.'/../vendor/autoload.php';

    $app = new \Slim\App([
        'settings' => [
            'diplayErrorDetails' => true,
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

        return $view;
    };

    $container['WebController'] = function ($container){
        return new \Crypto\Controllers\WebController($container);
    };

    $container['AuthController'] = function ($container){
        return new \Crypto\Controllers\AuthController($container);
    };

    $container['AppController'] = function ($container){
        return new \Crypto\Controllers\AppController($container);
    };

    require __DIR__.'/../routes/routes.php';