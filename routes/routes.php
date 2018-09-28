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

    $app->get('/help', 'WebController:help')->setName('help');


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

        $this->get('/dashboard', 'AppController:dashboard')->setName('app.dashboard');
        $this->get('/buy', 'AppController:buy')->setName('app.buy');
        $this->get('/sell', 'AppController:sell')->setName('app.sell');

        $this->get('/trade', 'AppController:trade')->setName('app.trade');
        $this->post('/trade', 'BuySellController:postAd');

        $this->get('/wallet', 'AppController:wallet')->setName('app.wallet');
        $this->get('/account-settings', 'AppController:accountsettings')->setName('app.account-settings');


    })->add( new DashboardMiddleware($container) );


    $app->get('/coin-rates-api', 'RatesController:getCoinRates');
    $app->get('/exchange-rates-api', 'RatesController:getExchangeRates');

    

