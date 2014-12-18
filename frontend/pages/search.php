<?php
require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."data_objects/search.php");
require_once(FRAMEWORK_PATH."data_objects/ProductSearch.php");

class searchPage extends Page 
{
    protected $template	= 'Pages/search.tpl';

    protected 	$CSS = array("/frontend/webcontent/css/catalog.css");
    protected 	$JS = array("/frontend/webcontent/js/url.min.js");

    public function load()
    {
        if (!isset($_GET ['page'])){
            $currentPage = 1;
        }else{
            if (Request::getInt('page')){
                $currentPage = Request::getInt('page');
            }else{
                $this->pageNotFound();
            }
        }
        $sort = Request::getValue('sort')?Request::getValue("sort","GET"):'';
        $sortType = Request::getValue('type')?Request::getValue("type","GET"):'';

        $this->pageData = new PageData($this->getPageId());

        if(!$this->pageData->load())
			throw new CMSExeption("Data for this page was not loaded");

	    $this->templateData['title'] = $this->pageData->getValue('title');
	    $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));


		if($sfKeyWord = request::getString("sfKeyWord","GET",true))
		{
			$this->templateData['sfKeyWord'] = $sfKeyWord;
            $typeofsearch = $this->pageData->getValue('number1');

            if(is_numeric($this->pageData->getValue('number2')))
                $countOnPage = $this->pageData->getValue('number2');
            else
                $countOnPage= 0;
            $this->templateData['countOnPage'] = $countOnPage;
            $this->templateData['currentPage'] = $currentPage;
            $this->templateData['langId'] =$this->pageData->getValue('langId');

            if($typeofsearch == 0){
                $searchObj = new Search($this->pageData->getValue('langId'));
            }
            else{
                $searchObj = new ProductSearch($this->pageData->getValue('langId'));
            }
			if($searchObj->searchLikeKeyWord($sfKeyWord, $sort, $sortType, $countOnPage, $currentPage, 0, $countOnPage*$currentPage))
			{
                $this->templateData['sfKeyWord'] = $sfKeyWord;
                $this->templateData['totalPages'] = $searchObj->total_pages;
                $this->templateData['sort'] = Request::getValue('sort');
                $this->templateData['sortType'] = Request::getValue('type');
                $this->templateData['products'] = $searchObj->searchResultItems;
				$this->templateData['searchCountItems'] = $searchObj->total_count;
                if ($searchObj->total_pages < $currentPage){
                    $this->pageNotFound();
                }
                $this->templateData['searchResult'] = $this->pageData->getValue('text2');
			}
			else
			{
                $this->templateData['products'] = $searchObj->searchResultItems;
                $this->templateData['totalPages'] = $searchObj->total_pages;
                $this->templateData['sort'] = Request::getValue('sort');
                $this->templateData['sortType'] = Request::getValue('type');
				$this->templateData['noSearchResult'] = $this->pageData->getValue('text1');
			}
		}
		else
		{
			$this->templateData['noSearchResult'] = $this->pageData->getValue('text1');
		}

        return $this->templateData;
    }
}
$newPage = new searchPage();
$newPage->run();
?>