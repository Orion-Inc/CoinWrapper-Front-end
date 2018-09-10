<?php
    namespace Swap\Validation\Rules;

    use Respect\Validation\Validator as v;
    use Respect\Validation\Rules\AbstractRule;

    class IsEmailPhone extends AbstractRule
    {
        protected $match = [
            'email' => "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i",
            'phone' => "/[0-9 -()+]+$/"
        ];

        public function validate($input)
        {
            if (preg_match($this->match['email'],$input)) {
                if(v::email()->validate($input)){
                    return true;
                }
            }

            if (preg_match($this->match['phone'],$input)) {
                if(v::phone()->validate($input)){
                    return true;
                }
            }

            return false;
        }
    }
    