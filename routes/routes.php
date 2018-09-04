<?php
    $app->get('/', 'WebController:home')->setName('home');

    $app->get('/about-us', 'WebController:aboutus')->setName('about-us');

    $app->get('/contact-us', 'WebController:contactus')->setName('contact-us');

    $app->get('/faqs', 'WebController:faqs')->setName('faqs');

    $app->get('/buy-sell', 'WebController:listBuySell')->setName('buy-sell');


    $app->get('/sign-in', 'AuthController:signin')->setName('auth.signin');

    $app->get('/sign-up', 'AuthController:signup')->setName('auth.signup');