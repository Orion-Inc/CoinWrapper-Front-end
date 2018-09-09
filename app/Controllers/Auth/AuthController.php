<?php
    namespace Crypto\Controllers\Auth;

    use Crypto\Classes\Auth;
    use Crypto\Models\User;
    use Crypto\Controllers\Controller;
    use Respect\Validation\Validator as v;
    use Crypto\Classes\Stringify;

    class AuthController extends Controller
    {
        public function signup($request, $response)
        {
            return $this->view->render($response, 'auth/signup.twig', [
                'pageTitle' => 'Sign Up',
                'uri'=> 'sign-up'
            ]);
        }

        public function postSignup($request, $response)
        {
            $valaidation = $this->validator->validate($request, [
                'firstname' => v::notEmpty()->alpha()->setName('First Name'),
                'othernames' => v::notEmpty()->alpha()->setName('Other Names'),
                'username' => v::noWhitespace()->notEmpty()->alpha()->setName('Username'),
                'email' => v::noWhitespace()->notEmpty()->email()->setName('Email Address'),
                'phonenumber' =>  v::noWhitespace()->notEmpty()->phone()->setName('Phone Number')
            ]);

            if($valaidation->invalidate()){
                return $response->withRedirect($this->router->pathFor('auth.sign-up'));
            }

            $user = User::create(
                [
                    'firstname' => Stringify::capFirstLetters($request->getParam('firstname')),
                    'othername' => Stringify::capFirstLetters($request->getParam('othernames')),
                    'username' => $request->getParam('username'),
                    'email' => $request->getParam('email'),
                    'phone' => $request->getParam('phonenumber')
                ],
                $request->getMethod(),
                '/signup'
            );
            
            if($user['success'] == false){
                $this->flash->addMessage('message', $user['message']);
                return $response->withRedirect($this->router->pathFor('auth.sign-up'));
            }

            return $response->withRedirect($this->router->pathFor('auth.authorize'));
        }

        public function signin($request, $response)
        {
            return $this->view->render($response, 'auth/signin.twig', [
                'pageTitle' => 'Sign In',
                'uri'=> 'sign-in'
            ]);
        }

        public function postSignin($request, $response)
        {
            $valaidation = $this->validator->validate($request, [
                'emailphonennumber' => v::notEmpty()->noWhitespace()->signin()->setName('Email or Phone Number')
            ]);

            if($valaidation->invalidate()){
                return $response->withRedirect($this->router->pathFor('auth.sign-in'));
            }

            $auth = Auth::authorize(
                [
                    'credentials' => $request->getParam('emailphonennumber'),
                    'authmethod' => $request->getParam('authmethod')
                ],
                $request->getMethod(),
                '/api/v1/authenticate'
            );

            if($auth['success'] == false){
                $this->flash->addMessage('message', $auth['message']);
                return $response->withRedirect($this->router->pathFor('auth.sign-in'));
            }

            return $response->withRedirect($this->router->pathFor('auth.authorize'));
        }

        public function authorize($request, $response)
        {
            return $this->view->render($response, 'auth/authorize.twig', [
                'pageTitle' => 'Authorize',
                'uri'=> 'authorize'
            ]);
        }

        public function signout($request, $response)
        {
            $this->auth->signout();
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }
    