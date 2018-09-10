<?php 
    use Swap\Middleware\AuthMiddleware;
    use Swap\Middleware\GuestMiddleware;
    use Swap\Middleware\DashboardMiddleware;

    $app->get('/', 'WebController:index')->setName('home');

    $app->get('/about-us', 'WebController:aboutus')->setName('about-us');

    $app->get('/contact-us', 'WebController:contactus')->setName('contact-us');

    $app->get('/faqs', 'WebController:faqs')->setName('faqs');

    $app->get('/buy-sell', 'WebController:buySell')->setName('buy-sell');

    $app->get('/terms-of-service', 'WebController:termsofservice')->setName('terms-of-service');



    $app->group('', function() {
        $this->get('/sign-up', 'AuthController:signup')->setName('auth.sign-up');
        $this->post('/sign-up', 'AuthController:postSignup');

        $this->get('/sign-in', 'AuthController:signin')->setName('auth.sign-in');
        $this->post('/sign-in', 'AuthController:postSignin');

        $this->get('/authorize/{email}', 'AuthController:checkAuthorization');
    })->add( new GuestMiddleware($container) );

    $app->group('', function() {
        $this->get('/authorize', 'AuthController:authorize')->setName('auth.authorize');
    })->add( new AuthMiddleware($container) );



    $app->group('', function() {
        $this->get('/sign-out', 'AuthController:signout')->setName('auth.sign-out');

        $this->get('/dashboard', 'AppController:index')->setName('app.dashboard');
        $this->get('/account-settings', 'AppController:accountsettings')->setName('app.account-settings');
        $this->get('/help', 'AppController:help')->setName('app.help');
    })->add( new DashboardMiddleware($container) );

    

