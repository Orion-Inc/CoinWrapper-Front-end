<?php
    namespace Swap\Validation\Exceptions;

    use Respect\Validation\Exceptions\ValidationException as Exceptions;

    class IsEmailPhoneException extends Exceptions
    {
        public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Input Must Be A Valid Email Address or Phone Number'
            ],
        ];
    }
    