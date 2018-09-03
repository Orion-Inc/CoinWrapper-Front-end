<?php
    $app->get('/', 'HomeController:index');

    $app->get('/sign-in', function ($request, $response) {
        return $this->view->render($response, 'sign-in.twig');
    });

    $app->get('/sign-up', function ($request, $response) {
        return $this->view->render($response, 'sign-up.twig');
    });