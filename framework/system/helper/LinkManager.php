<?php
class LinkManager
{
    static function GetSystemPageUrl($viewId, $isDefaultLang = false)
    {
        if($isDefaultLang){
            $langs      =   Languages::getInstance();
            $langCode   =   $langs->DefaultLanguageCode();
            $langId     =   $langs->GetLangIdByCode($langCode);
        }
        else{
            $langId     =   Context::LanguageId();
            $langCode   =   Context::LanguageCode();
        }
        $query  =   "   SELECT fe_Pages.id, fe_Pages.codeName, be_View.className as className
                        FROM fe_Pages
                          INNER JOIN be_View ON fe_Pages.viewId = be_View.viewId
                        WHERE fe_Pages.viewId = {$viewId} AND fe_Pages.langId = ".$langId."
                        LIMIT 1";
        if(Context::DB()->query($query)){
            return appUrl::getUrl(Context::DB()->result[0]['id'], Context::DB()->result[0]['className'], Context::DB()->result[0]['codeName'], $langCode);
        }
        return  false;
    }

    static function GetUrlParameters($url, $checkPageClass=false)
    {
        $urlQuery = parse_url(appUrl::unRewriteUrl($url));

        if(!isset($urlQuery['query']))
            return;

        parse_str($urlQuery['query'], $vars);
        if($checkPageClass==true){
            preg_match_all('/[a-zA-Z_\-\d]+.php/', $urlQuery['path'], $out);
            $vars['pageclass'] = $out[0][0];
        }
        return $vars;
    }

}