<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");

class content extends Page 
{
    protected $template = 'Pages/content.tpl';
    protected 	$CSS = array("/frontend/webcontent/css/content.css");
    protected $requireAuthorization = false;

    public function load()
    {
        $cache = new CacheFace();
        if($data = $cache->get('contentPage_'.$this->getPageId()))
		    return unserialize($data);

        $data = new PageData($this->getPageId());
		if(!$data->load())
			throw new CMSExeption("Data for content page was not loaded. Pageid=".$this->getPageId());

		$pageData['title'] = $data->getValue('title');
		$pageData['html'] = appUrl::CMSConstantsToValues($data->getValue('html'));
		if($data->getValue('introHtml'))
		{
		    $pageData['introHtml'] = appUrl::CMSConstantsToValues($data->getValue('introHtml'));
		}

        $cache->save(serialize($pageData));
        return $pageData;
    }
}
$newPage = new content();
$newPage->run();
?>