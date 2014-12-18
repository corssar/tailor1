<?php
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';

class RewardManager
{
    protected $lang;

    function __construct($lang)
    {
        $this->lang = $lang?$lang:null;
    }

    public function getReward($count){
        $rewardViewId = 87;
        $whereParam = "";

        $cache = new CacheFace();
        if($cacheData = $cache->get('rewardpage_Reward_'.$count)){
            return unserialize($cacheData);
        }
        $whereParam .= " AND fe_Pages.visible=1";

        $query ="SELECT *
                 FROM fe_Pages
                 INNER JOIN be_View ON fe_Pages.Viewid = be_View.viewId
                 WHERE fe_Pages.viewid = $rewardViewId {$whereParam}
                 LIMIT 0, $count";

        if(!Context::DB()->query($query))
            return null;

        $result = Context::DB()->result;
        $results = array();
        $i = 0;
        foreach ($result as $item)
        {
            $results[$i]['title']				 = $item['title'];
            $results[$i]['shortDescription']	 = $item['shortDescription'];
            $results[$i]['url']				     = appUrl::getUrl($item['id'], 'reward.php', $item['codeName']);


            $i++;
        }
        $cache->save(serialize($results));
        return $results;
    }
}