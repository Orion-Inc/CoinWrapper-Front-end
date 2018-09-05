<?php
    namespace Crypto\Controllers\Auth;

    use Crypto\Models\User;
    use Crypto\Controllers\Controller;

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
            $user = User::create([
                'first-name' => $request->getParam('first-name'),
                'other-names' => $request->getParam('other-names'),
                'username' => $request->getParam('username'),
                'email' => $request->getParam('email'),
                'phone-number' => $request->getParam('phone-number')
            ]);

            
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
            $user = User::authenticate([
                'email-phoneNumber' => $request->getParam('email-phoneNumber'),
                'auth-method' => $request->getParam('auth-method')
            ]);


        }
    }
    