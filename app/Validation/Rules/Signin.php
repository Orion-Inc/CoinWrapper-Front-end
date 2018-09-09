<?php
    namespace Swap\Validation\Rules;

    use Respect\Validation\Validator as v;
    use Respect\Validation\Rules\AbstractRule;

    class Signin extends AbstractRule
    {
        protected $match = [
            'email' => "/^([w-.]+@([w-]+.)+[w-]{2,4})?$/",
            'phone' => "/[0-9 -()+]+$/"
        ];

        public function validate($input)
        {
            // print("<pre>".print_r($this->match,1)."</pre>");

            // if (preg_match($this->match['email'],$input)) {
                
            // }

            // if (preg_match($this->match['phone'],$input)) {
                
            // }
            return true;
        }
    }
    