<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/CategoryPage.php");
require_once(FRAMEWORK_PATH."system/webshop/productList.php");
require_once(FRAMEWORK_PATH."system/Paging.php");
require_once(FRAMEWORK_PATH."core/PageObjectBase.php");

class catalog extends CategoryPage
{
    protected $template = 'Pages/categories.tpl';

    protected 	$CSS = array("/frontend/webcontent/css/catalog.css");
    protected 	$JS = array("/frontend/webcontent/js/product.js",
        "/frontend/webcontent/js/url.min.js");

    public function load()
    {
        $this->templateData = array();
        $cache = new CacheFace();



        return $this->templateData;
    }
}
$newPage = new catalog();
$newPage->run();