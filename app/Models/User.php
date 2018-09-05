<?php
    namespace Crypto\Models;

    class User 
    {
        public static function create($args = array())
        {
            print("<pre>".print_r($args,1)."</pre>");
            
        }

        public static function authenticate($args = array())
        {
            print("<pre>".print_r($args,1)."</pre>");
            
        }
    }
    