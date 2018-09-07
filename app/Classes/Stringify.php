<?php
    namespace Crypto\Classes;

    class Stringify
    {
        public static function capFirstLetters($text)
        {
            return ucwords(strtolower($text));
        }
    }