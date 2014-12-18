<?php
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';

class HomeManager
{
    protected $lang;

    function __construct($lang)
    {
        $this->lang = $lang?$lang:null;
    }

    public function getHomePhotos ($pageId){

        $cache = new CacheFace();
        if($cacheData = $cache->get('homepage_photo_'.$pageId)){
            return unserialize($cacheData);
        }


        $query="SELECT photo.*
          FROM fe_PagesRelatedItems photo
	      INNER JOIN be_PageContent ON photo.id = be_PageContent.contentId
	      INNER JOIN fe_Pages ON be_PageContent.pageId = fe_Pages.id
	      WHERE fe_Pages.id = '$pageId'";

        if(!Context::DB()->query($query))
            return null;

        $result = Context::DB()->result;
        $results = array();
        $i = 0;
        foreach ($result as $item)
        {
            $results[$i]['title']	 = $item['title'];
            $results[$i]['URL']		 = appUrl::checkUrl($item['text1']);
            $results[$i]['slogan']	 = $item['text2'];
            $results[$i]['shortDescription'] = explode('<br />', nl2br($item['shortDescription']));
            $i++;
        }

        $cache->save(serialize($results));
        return $results;

    }
}
