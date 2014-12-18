<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once(FRAMEWORK_PATH."system/helper/HomeManager.php");
require_once(FRAMEWORK_PATH."system/webshop/productList.php");
require_once(FRAMEWORK_PATH."system/Paging.php");

class home extends Page
{
    protected $template = 'Pages/home.tpl';

    protected 	$CSS = array("/frontend/webcontent/css/colorscheme.css",
                             "/frontend/webcontent/css/jsScrollPane.css");
    protected 	$JS = array("/frontend/webcontent/js/jquery.thslide.min.js",
                            "/frontend/webcontent/js/jquery.mousewheel.js",
                            "/frontend/webcontent/js/jquery.jscrollpane.min.js");

    public function load()
    {
        $viewObj = new SmartyView();
        $arrayData = array();
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
            $this->templateData['title'] = $this->pageData->getValue('title');
            $this->templateData['html'] = appUrl::CMSConstantsToValues($this->pageData->getValue('html'));


            $products = new ProductList($this->pageData->getValue('langId'));
            $arrayData['testCount'] = $products->getProductsList(8, null, 0, 'productId','asc', 8);

            $this->templateData['newProductsObject'] = $viewObj->fetch(FRONTEND_PATH . "webcontent/templates/PageObjects/newProductsObject.tpl", $arrayData);

            $this->templateData['popularProductsObject'] = $viewObj->fetch(FRONTEND_PATH . "webcontent/templates/PageObjects/popularProductsObject.tpl", $arrayData);
            /*$this->templateData['actionProductsObject'] = $viewObj->fetch(FRONTEND_PATH . "webcontent/templates/PageObjects/actionProductsObject.tpl", $arrayData);
            $this->templateData['newProductsObject'] = $viewObj->fetch(FRONTEND_PATH . "webcontent/templates/PageObjects/newProductsObject.tpl", $arrayData);
            $this->templateData['bestProducersObject'] = $viewObj->fetch(FRONTEND_PATH . "webcontent/templates/PageObjects/bestProducersObject.tpl", $arrayData);*/


            $this->templateData['currentPageUrl'] = appUrl::getUrl($this->getPageId(), 'home.php');

            $homeManager = new HomeManager(Context::LanguageId());

            $this->templateData['photos']  = $homeManager->getHomePhotos($this->getPageId());

        }

        Context::PageId($this->getPageId());
        return $this->templateData;
    }
}
$newPage = new home();
$newPage->run();