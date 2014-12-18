<?php
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/webshop/productList.php");
require_once(FRAMEWORK_PATH."data_objects/ProductSearch.php");

class productController
{
    public static function addScrollPaging()
    {
        $countOnPage = Request::getInt('countOnPage',"POST");
        $categoryId = Request::getInt('categoryId',"POST");
        $currentPage = Request::getInt('currentPage',"POST");
        $sort = Request::getString('sort',"POST");
        $sortType = Request::getString('sortType',"POST");
        $langId = Request::getInt('langId',"POST");
        $product = ProductList::getInstance($langId);
        $start = abs((($currentPage - 1) * $countOnPage));
        $productListTemplateData['products']  = $product->getProductsList($countOnPage, $currentPage, $categoryId, $sort, $sortType, $start, $countOnPage);
        $view = new SmartyView();
        $response['productList'] = $view->fetch(FRONTEND_TEMPL_PATH.'Pages/viewproducts.tpl', $productListTemplateData);
        return $response;
    }

    public static function addSearchScrollPaging()
    {
        $countOnPage = Request::getInt('countOnPage',"POST");
        $currentPage = Request::getInt('currentPage',"POST");
        $sort = Request::getString('sort',"POST");
        $sortType = Request::getString('sortType',"POST");
        $sfKeyWord = Request::getString('sfKeyWord',"POST");
        $langId = Request::getInt('langId',"POST");
        $product = new ProductSearch($langId);
        $start = abs((($currentPage - 1) * $countOnPage));
        if ($product->searchLikeKeyWord($sfKeyWord, $sort, $sortType, $countOnPage, $currentPage, $start, $countOnPage)){
            $productListTemplateData['products']  =  $product->searchResultItems;
        }else{
            $productListTemplateData['products'] = array();
        }
        $view = new SmartyView();
        $response['searchList'] = $view->fetch(FRONTEND_TEMPL_PATH.'Pages/viewproducts.tpl', $productListTemplateData);
        return $response;
    }

}
