<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."custom/News.php");
require_once(FRAMEWORK_PATH."custom/tagsManagment.php");
require_once(FRAMEWORK_PATH."system/WebText.php");
require_once(FRAMEWORK_PATH."system/helper/NewsManager.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';

class newsPage extends Page
{
    protected $template	=	'Pages/news.tpl';

    public function load()
    {
        //$webText = new WebText($template);


        $this->pageData = new PageData($this->getPageId());
        if(!$this->pageData->load())
        {
            throw new CMSExeption("Data for this page was not loaded");
        }

        if($this->pageData->getValue('title'))
        {
            $this->templateData['title'] = $this->pageData->getValue('title');
        }

        $this->templateData['newsId'] = $this->getPageId();

        $this->templateData['date']= $this->pageData->getValue('dateStartVisible');

        $this->templateData['html'] = appUrl::CMSConstantsToValues($this->pageData->getValue('html'));
        $newsManager =	new NewsManager($this->pageData->getValue('langId'));
        $this->templateData['photos'] = $newsManager->getNewsPhotos($this->getPageId());
        Context::PageId($this->getPageId());
        return $this->templateData;
    }

}
$newPage = new newsPage();
$newPage->run();