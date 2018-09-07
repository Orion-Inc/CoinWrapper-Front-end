<?php
    $app->get('/', 'WebController:index')->setName('home');

    $app->get('/about-us', 'WebController:aboutus')->setName('about-us');

    $app->get('/contact-us', 'WebController:contactus')->setName('contact-us');

    $app->get('/faqs', 'WebController:faqs')->setName('faqs');

    $app->get('/buy-sell', 'WebController:listBuySell')->setName('buy-sell');


    $app->get('/sign-in', 'AuthController:signin')->setName('auth.signin');
    $app->post('/sign-in', 'AuthController:postSignin');

    $app->get('/sign-up', 'AuthController:signup')->setName('auth.signup');
    $app->post('/sign-up', 'AuthController:postSignup');


    $app->get('/dashboard', 'AppController:index')->setName('app.dashboard');
    $app->get('/account-settings', 'AppController:accountsettings')->setName('app.account-settings');
    $app->get('/help', 'AppController:help')->setName('app.help');

