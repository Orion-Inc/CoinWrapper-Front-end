<?php
    namespace Swap\Classes;

    class Stringify
    {
        public static function capFirstLetters($text)
        {
            return ucwords(strtolower($text));
        }
    }