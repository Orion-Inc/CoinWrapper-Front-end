<?php
    namespace Crypto\Classes;

    class Auth
    {
        public static function authenticate($args = array())
        {
            print("<pre>".print_r($args,1)."</pre>");
            
        }

        public static function session()
        {
            if(isset($_SESSION['user'])){
                return $_SESSION['user'];
            }
        }

        public static function checkSession()
        {
            return isset($_SESSION['user']);
        }
    }