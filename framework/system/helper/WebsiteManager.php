<?php
/**
 * Created by max melissen.
 *
 */
class WebsiteManager
{
    static public function getWebsitesWithLanguages()
    {
        if(!Context::DB()->query('select id, name, URL from be_WebSites'))
            return false;
        $websites = Context::DB()->result;

        if(!Context::DB()->query('select langId, websiteId from be_WebsiteLanguages ORDER BY websiteId, id'))
            return false;

        include_once(FRAMEWORK_PATH.'system/helper/ArrayManager.php');
        foreach(Context::DB()->result as $websiteLanguageRelation)
        {
            $key = ArrayManager::subarray_search(Array('id'=>$websiteLanguageRelation['websiteId']),$websites);
            If($key!==false)
            {
                if(!isset($websites[$key]['languages']) || !is_array($websites[$key]['languages']))
                    $websites[$key]['languages'] = array();

                array_push($websites[$key]['languages'], $websiteLanguageRelation['langId']);
            }
        }

        return $websites;
    }
}
