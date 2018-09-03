<?php
    $app->get('/', 'HomeController:index')->setName('home');

    $app->get('/sign-in', 'AuthController:signin')->setName('auth.signin');

    $app->get('/sign-up', 'AuthController:signup')->setName('auth.signup');