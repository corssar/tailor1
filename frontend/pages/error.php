<?php
if(file_exists('../../config.php'))
	require_once '../../config.php';
require_once(FRAMEWORK_PATH.'system/Context.php');
require_once(FRAMEWORK_PATH."core/Page.php");

class error extends Page 
{
    private $data;
    protected $template = 'Pages/error.tpl'; 

    public function load()
    {
        $pageData = array();
        
        $cache = new CacheFace();		
        if($data = $cache->get('errorpage_'.$this->getPageId()))
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
				if($data->getValue('html'))
				{
				    $pageData['html'] = appUrl::CMSConstantsToValues($data->getValue('html'));
				}
			}
			$cache->save(serialize($pageData));
		}			
        return $pageData;
    }
}
$newPage = new error();
$newPage->run();
?>