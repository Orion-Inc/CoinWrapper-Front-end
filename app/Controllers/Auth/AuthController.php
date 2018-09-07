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
                'firstname' => v::notEmpty()->alpha(),
                'othernames' => v::notEmpty()->alpha(),
                'username' => v::noWhitespace()->notEmpty()->alpha(),
                'email' => v::noWhitespace()->notEmpty()->email(),
                'phonenumber' =>  v::noWhitespace()->notEmpty()->phone()
            ]);

            if($valaidation->invalidate()){
                return $response->withRedirect($this->router->pathFor('auth.signup'));
            }

            $user = User::create([
                'firstname' => Stringify::capFirstLetters($request->getParam('firstname')),
                'othernames' => Stringify::capFirstLetters($request->getParam('othernames')),
                'username' => $request->getParam('username'),
                'email' => $request->getParam('email'),
                'phone-number' => $request->getParam('phonenumber')
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
            $valaidation = $this->validator->validate($request, [
                'emailphonennumber' => v::notEmpty()->noWhitespace()->signin()
            ]);

            if($valaidation->invalidate()){
                return $response->withRedirect($this->router->pathFor('auth.signin'));
            }

            $auth = Auth::authenticate([
                'emailphonennumber' => $request->getParam('emailphonennumber'),
                'authmethod' => $request->getParam('authmethod')
            ]);

            if(!$auth){
                return $response->withRedirect($this->router->pathFor('auth.signin'));
            }

            return $response->withRedirect($this->router->pathFor('app.dashboard'));
        }

        public function signout($request, $response)
        {
            
        }
    }
    