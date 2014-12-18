<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/siteTree.php");

class siteMap extends Page 
{
    private $data;
    protected $template = 'Pages/siteMap.tpl';

    public function load()
    {
        $pageData = array();
        
        $cache = new CacheFace();		
        if($data = $cache->get('sitemappage_'.$this->getPageId()))
		{
   			$pageData = unserialize($data);
		}
		else 
		{
	        $data = new PageData($this->getPageId());
			if($data->load())
			{
				if($data->getValue('title'))
				{
				    $pageData['title'] = $data->getValue('title');
				}		
				if($data->getValue('introHtml'))
				{
				    $pageData['introHtml'] = appUrl::CMSConstantsToValues($data->getValue('introHtml'));
				}
				if($data->getValue('html'))
				{
				    $pageData['html'] = appUrl::CMSConstantsToValues($data->getValue('html'));
				}
				
				$siteTree = &siteTree::getInstance((int)$data->getValue('number1'));
	    		if($siteTree->isMenuLoaded())
	    		{
	    			$pageData['treeItems'] = $siteTree->menuItems;
	    		}
			}
			$cache->save(serialize($pageData));
		}			
        return $pageData;
    }
}
$newPage = new siteMap();
$newPage->run();
?>