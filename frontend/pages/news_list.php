<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/helper/NewsManager.php");
require_once(FRAMEWORK_PATH."custom/tagsManagment.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once FRAMEWORK_PATH.'system/Paging.php';


class newsList extends Page
{
    protected $template = 'Pages/news_list.tpl';

    public function load()
    {
        $currentPage = (Request::getInt('page', 'GET')) ? Request::getInt('page', 'GET'): 1;
        $this->pageData = new PageData($this->getPageId());
        if(!$this->pageData->load())
            throw new CMSExeption("Data for this page was not loaded");


        if($this->pageData->getValue('title'))
        {
            $this->templateData['title'] = $this->pageData->getValue('title');
        }

        $categoryId = null;
        if($this->pageData->getValue('number1'))
        {
            $categoryId = $this->pageData->getValue('number1');
        }

        if($this->pageData->getValue('introHtml'))
        {
            $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
        }

        $this->templateData['currentPageUrl'] = appUrl::getUrl($this->getPageId(), 'news_list.php');

        if(is_numeric($this->pageData->getValue('number2')))
            $countOnPage = $this->pageData->getValue('number2');
        else
            $countOnPage= 0;


        $newsManager = new NewsManager(Context::LanguageId());
        $this->templateData['news_list'] = $newsManager->getNewsContent($countOnPage, $currentPage, $categoryId);
        Context::PageId($this->getPageId());
        $this->templateData['paging'] = Paging::buildPaganation($newsManager->total_pages, $currentPage, appUrl::getUrl($this->getPageId(), 'news_list.php', $this->getPageCode()));
        return $this->templateData;
    }
}

$newPage = new newsList();
$newPage->run();