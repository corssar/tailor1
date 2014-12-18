<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");

class service extends Page 
{
    protected $template = 'Pages/service.tpl';  

    public function load()
    {
        $cache = new CacheFace();		
        if($cacheData = $cache->get('servicepage_'.$this->getPageId()))
		{
   			$this->templateData = unserialize($cacheData);
		}
		else 
		{
	        $this->pageData = new PageData($this->getPageId());
			if($this->pageData->load())
			{
				$this->templateData['title'] = $this->pageData->getValue('title');

				$categoryData = $this->getCategoryData($this->pageData->getValue('number1'));
				$this->templateData['title1'] = $categoryData['title1'];
				$this->templateData['title2'] = $categoryData['title2'];
				$this->templateData['color'] = $categoryData['color'];
				$this->templateData['html'] = appUrl::CMSConstantsToValues($this->pageData->getValue('html'));
			}
			$cache->save(serialize($this->templateData));
		}			
        return $this->templateData;
    }
    private function getCategoryData($categoryId)
    {
    	if(!Context::DB()->query('select title1, title2, description as color from be_ListItems where id='.$categoryId))
    		throw new CMSException('Error on service page. Can\'not retrieve category with id :'.$categoryId);

		return Context::DB()->result[0];
    }
}
$newPage = new service();
$newPage->run();
?>