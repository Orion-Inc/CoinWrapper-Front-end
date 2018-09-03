<?php
    $app->get('/', function ($request, $response) {
        return $this->view->render($response, 'home.twig');
    });

    $app->get('/sign-in', function ($request, $response) {
        return $this->view->render($response, 'sign-in.twig');
    });

    $app->get('/sign-up', function ($request, $response) {
        return $this->view->render($response, 'sign-up.twig');
    });