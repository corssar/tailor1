<?php
class LanguagesRelationManager
{
    private static $customPages = array("orderModerationPreview.php");

    public static function GetRelatedUrl($Url, $requestedLangId=null, $requestedWebsiteId=null)
    {
        include_once(FRAMEWORK_PATH."system/helper/LinkManager.php");

        $urlParams = LinkManager::GetUrlParameters($Url, true);
        if(!isset($urlParams['pageclass'])){
            //not valid URL
            return $Url;
        }
        $requestedLangId    = is_null($requestedLangId)?Context::LanguageId():$requestedLangId;
        $requestedWebsiteId = is_null($requestedWebsiteId)?Context::SiteSettings()->getSiteId():$requestedWebsiteId;

        if(in_array($urlParams['pageclass'], self::$customPages))
            return self::GetCustomPageUrl($Url, $requestedLangId);
        else
            return self::GetPageUrl($urlParams, $requestedLangId, $requestedWebsiteId);
    }

    private function GetPageUrl($urlParams, $requestedLangId, $requestedWebsiteId)
    {
        $query = "Select tblName from be_View Where className = '".$urlParams['pageclass']."'";
        if(!Context::DB()->query($query))
            return false;
        $tableName = Context::DB()->result[0]['tblName'];

        $language = Languages::getInstance();
        $urlLangId = $language->GetLangIdByCode($urlParams['lang']);

        $query = "SELECT relations.id, relations.codeName, relations.langId, be_Languages.code, be_View.className
                  from $tableName page
                    left join $tableName relations on page.relationId = relations.relationId
                    inner join be_Languages on relations.langId = be_Languages.id
                    inner join be_View on relations.viewId = be_View.viewId
                  where page.codeName = '{$urlParams['pagecode']}' AND page.langId = $urlLangId AND relations.langId = $requestedLangId AND relations.websiteId = $requestedWebsiteId
                  LIMIT 1";

        if(!Context::DB()->query($query))
            return false;

        return appUrl::getUrl(Context::DB()->result[0]['id'], Context::DB()->result[0]['className'], Context::DB()->result[0]['codeName'], $language->GetCodeById($requestedLangId));
    }

    private function GetCustomPageUrl($url, $requestedLangId)
    {
        $language = Languages::getInstance();
        $requestedLangCode = $language->GetCodeById($requestedLangId);
        return str_replace('/'.Context::LanguageCode().'/', '/'.$requestedLangCode.'/', $url);

    }

    public static function GetRelatedPages($pageId, $tableName='fe_Pages')
    {
        $pageClass = basename($_SERVER['SCRIPT_NAME']);
        if(in_array($pageClass, self::$customPages))
            return self::GetRelatedCustomPages($pageId, $pageClass, LinkManager::GetUrlParameters($_SERVER['REQUEST_URI']));
        else
            return self::GetRelatedPagesUrls($pageId, $tableName);

    }

    private static function GetRelatedPagesUrls($pageId, $tableName='fe_Pages')
    {
        include_once(FRAMEWORK_PATH."system/appUrl.php");
        $relatedPagesDB = array();

        if( Context::DB()->query('SELECT * FROM '.$tableName.' LIMIT 1') && array_key_exists('relationId',Context::DB()->result[0]) )
        {
            $query = "SELECT relations.id, relations.codeName, relations.langId, be_Languages.code, be_View.className
                      from $tableName page
                        left join $tableName relations on page.relationId = relations.relationId
                        inner join be_Languages on relations.langId = be_Languages.id
                        inner join be_View on relations.viewId = be_View.viewId
                      where page.id = $pageId";
            if(!Context::DB()->query($query))
                return false;
            $relatedPagesDB = Context::DB()->result;
        }

        $language = Languages::getInstance();
        $defaultPageParams = Context::SiteSettings()->getDefaultPageParams();
        include_once(FRAMEWORK_PATH."system/helper/ArrayManager.php");
        foreach ($language->GetAppLanguages() as $code=>$langInfo)
        {
            if(($key = ArrayManager::subarray_search(array("langId"=>$langInfo["id"]), $relatedPagesDB)) !== false){

                if( $relatedPagesDB[$key]['code']==$language->DefaultLanguageCode() &&
                    $relatedPagesDB[$key]['codeName'] == $defaultPageParams['pagecode'] )
                {
                    $relatedPages[$code]['url'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl();
                    continue;
                }
                $relatedPages[$code]['url'] = appUrl::getUrl($relatedPagesDB[$key]["id"], $relatedPagesDB[$key]["className"], $relatedPagesDB[$key]["codeName"], $code);
            }
            else{
                if($langInfo['default'])
                    $relatedPages[$code]['url'] = SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl();
                else
                    $relatedPages[$code]['url'] = appUrl::checkUrl($langInfo['url']);
            }
        }
        return $relatedPages;
    }

    private function GetRelatedCustomPages($pageId, $pageClass, $urlParams)
    {
        $urlParametersStr = '';
        if(is_array($urlParams) && count($urlParams)>0){
                $urlParametersStr = "?".http_build_query($urlParams);
        }
        $language = Languages::getInstance();
        foreach ($language->GetAppLanguages() as $code=>$langInfo){
            $relatedPages[$code]['url'] = appUrl::getUrl($pageId, $pageClass, null, $code).$urlParametersStr;
        }
        return $relatedPages;
    }

}