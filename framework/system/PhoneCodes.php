<?php

class PhoneCodes
{
    public static function getCodes()
    {
        $query = "SELECT id, code FROM fe_PhoneCodes WHERE langId = ".Context::LanguageId()." ORDER BY code";
        if(Context::DB()->query($query)){
            return Context::DB()->result;
        }
        return array();
    }

}