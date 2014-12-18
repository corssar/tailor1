<?php
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';

class VacancyManager
{
    protected $lang;
    public $total_count;
    public $total_pages;

    function __construct($lang)
    {
        $this->lang = $lang?$lang:null;
    }

    public function getVacancyPhotos ($pageId){

        $cache = new CacheFace();
        if($cacheData = $cache->get('vacancypage_photo_'.$pageId)){
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
            $results[$i]['shortDescription']	 = $item['shortDescription'];
            $results[$i]['URL']					 = appUrl::checkUrl($item['text3']);
            $results[$i]['date']				 = $item['dateStartVisible'];


            $i++;
        }

        $cache->save(serialize($results));
        return $results;

    }

    public function getVacancyContent($countOnPage = 20, $currentPage = 0)
    {
        $vacancyViewId = 85;
        $whereParam = "";

        $cache = new CacheFace();
        if($cacheData = $cache->get('vacancypage_content_'.$countOnPage.'_'.$currentPage)){
            $data = unserialize($cacheData);
            $this->total_count = $data['total_count'];
            $this->total_pages = $data['total_pages'];
            return $data['results'];
        }


        $start = abs(($currentPage * $countOnPage));

        if($this->lang)
        {
            $whereParam .= ' AND fe_Pages.langId = '.$this->lang;
        }

        $whereParam .= " AND fe_Pages.visible=1";

        $query ="SELECT SQL_CALC_FOUND_ROWS
                 fe_Pages.*,
                 be_View.className as classname
                 FROM fe_Pages
                 INNER JOIN be_View ON fe_Pages.Viewid = be_View.viewId
                 WHERE fe_Pages.viewid = $vacancyViewId
                       {$whereParam} LIMIT $start,".$countOnPage;

        if(!Context::DB()->query($query))
            return null;

        $result = Context::DB()->result;

        $query = "SELECT FOUND_ROWS() as count";
        Context::DB()->query($query);

        $this->total_count = Context::DB()->result[0]['count'];
        $this->total_pages = ceil($this->total_count/$countOnPage);

        $results = array();
        $i = 0;
        foreach ($result as $item)
        {
            $results[$i]['title']				 = $item['title'];
            $results[$i]['shortDescription']	 = $item['shortDescription'];
            $results[$i]['URL']					 = appUrl::getUrl($item['id'], $item['classname'], $item['codeName']);
            $results[$i]['date']				 = $item['dateStartVisible'];

            $i++;
        }
        $data = array('results'=>$results, 'total_count'=>$this->total_count, 'total_pages'=>$this->total_pages);

        $cache->save(serialize($data));

        return $results;
    }
}
