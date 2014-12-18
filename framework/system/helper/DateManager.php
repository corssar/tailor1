<?php

class DateManager
{
    static function convert2phpDateFormat($dateFormat)
    {
        $str = str_replace('d', 'j', $dateFormat);
        $str = str_replace('m', 'n', $str);
        $str = str_replace('jj', 'd', $str);
        $str = str_replace('nn', 'm', $str);
        $str = str_replace('yy', 'Y', $str);
        return $str;
    }
}