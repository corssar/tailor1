<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/CategoryPage.php");
require_once(FRAMEWORK_PATH."system/webshop/productList.php");
require_once(FRAMEWORK_PATH."system/Paging.php");
require_once(FRAMEWORK_PATH."core/PageObjectBase.php");

class catalog extends CategoryPage
{
    protected $template = 'Pages/catalog.tpl';

    protected 	$CSS = array("/frontend/webcontent/css/catalog.css");
    protected 	$JS = array("/frontend/webcontent/js/product.js",
                            "/frontend/webcontent/js/url.min.js");

    public function load()
    {
        $this->templateData = array();
        $cache = new CacheFace();
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

        if($this->pageData = $cache->get('catalogPage_'.$this->getPageId().'_'.$currentPage.'_'.$sort.'_'.$sortType))
		{
   			$this->templateData = unserialize($this->pageData);
		}
		else
		{
	        $this->pageData = new CategoryPageData($this->getPageId());
            if(!$this->pageData->load())
                throw new CMSExeption("Data for this page was not loaded");

            $this->templateData['title'] = $this->pageData->getValue('title');
            $this->templateData['introHtml'] = appUrl::CMSConstantsToValues($this->pageData->getValue('introHtml'));
            $this->templateData['description'] = appUrl::CMSConstantsToValues($this->pageData->getValue('description'));

            $products = new ProductList($this->pageData->getValue('langId'));
            $categoryId = $this->pageData->getValue('id');
            //$this->templateData['sort'] = Request::getValue('sort');
            //$this->templateData['sortType'] = Request::getValue('type');

            if(is_numeric($this->pageData->getValue('number2')))
                $countOnPage = $this->pageData->getValue('number2');
            else
                $countOnPage= 0;
            //$this->templateData['countOnPage'] = $countOnPage;
            //$this->templateData['currentPage'] = $currentPage;
            //$this->templateData['categoryId'] = $categoryId;
            $this->templateData['langId'] = $this->pageData->getValue('langId');
            $this->templateData['categories'] = self::getSubCategories($categoryId);
            $this->templateData['products'] = $products->getProductsList($countOnPage, $currentPage, $categoryId, Request::getValue('sort'), Request::getValue('type'), $countOnPage);
            if ($products->total_pages > 0 && $products->total_pages < $currentPage){
                $this->pageNotFound();
            }
            //$this->templateData['totalPages'] = $products->total_pages;
            $this->templateData['paging'] = Paging::buildPaganation($products->total_pages, $currentPage, appUrl::getUrl($this->getPageId(), 'catalog.php', $this->getPageCode()));
    		$cache->save(serialize($this->templateData));
		}
        return $this->templateData;
    }

    private static function getSubCategories($catId){
        $sql = "SELECT
                    pCat.title,
                    pCat.codeName,
                    v.className
                FROM
                    fe_ProductCategories pCat
                INNER JOIN be_View v ON v.viewId = pCat.viewId
                WHERE
                    pCat.parentId = '{$catId}'";

        if(!Context::DB()->query($sql))
            return array();

        $subCategories = array();

        foreach (Context::DB()->result as $k => $v) {
            $v['link'] = appUrl::getUrlByCode($v['codeName'], $v['className']);
            $subCategories[] = $v;
        }


        return $subCategories;
    }

}
$newPage = new catalog();
$newPage->run();