<?php

class StringHelper
{
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        $start  = $length * -1;
        return (substr($haystack, $start) === $needle);
    }
}
