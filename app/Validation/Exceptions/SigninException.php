<?php
    namespace Crypto\Validation\Exceptions;

    use Respect\Validation\Exceptions\ValidationException as Exceptions;

    class SigninException extends Exceptions
    {
        

        public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Email Address of Phone Number does not exist'
            ],
        ];
    }
    