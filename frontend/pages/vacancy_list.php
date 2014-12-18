<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/helper/VacancyManager.php");
require_once(FRAMEWORK_PATH."custom/tagsManagment.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once FRAMEWORK_PATH.'system/Paging.php';

class vacancyList extends Page
{
    protected $template = 'Pages/vacancy_list.tpl';

    public function load()
    {
        $currentPage = (Request::getInstance()->getInt('page', 'GET')) ? Request::getInstance()->getInt('page', 'GET') : 0;
        $this->pageData = new PageData($this->getPageId());
        if(!$this->pageData->load())
            throw new CMSExeption("Data for this page was not loaded");


        if($this->pageData->getValue('title'))
        {
            $this->templateData['title'] = $this->pageData->getValue('title');
        }

        if($this->pageData->getValue('introHtml'))
        {
            $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
        }

        $this->templateData['currentPageUrl'] = appUrl::getUrl($this->getPageId(), 'vacancy_list.php');

       if(is_numeric($this->pageData->getValue('number2')))
            $countOnPage = $this->pageData->getValue('number2');
        else
            $countOnPage= 0;


        $vacancyManager = new VacancyManager(Context::LanguageId());
        $this->templateData['vacancy_list'] = $vacancyManager->getVacancyContent($countOnPage, $currentPage);
        Context::PageId($this->getPageId());

        $this->templateData['paging'] = Paging::buildPaganation($vacancyManager->total_pages, $currentPage, appUrl::getUrl($this->getPageId(), 'vacancy_list.php', $this->getPageCode()));

        return $this->templateData;
    }
}

$vacancyList = new vacancyList();
$vacancyList->run();
