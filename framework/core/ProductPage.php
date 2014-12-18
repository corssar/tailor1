<?php
/**
 * ProductPage. Base class for Products pages.
 *
 * @author Maxim Melnichuk
 * @package 1.0.1
 */
require_once(FRAMEWORK_PATH."core/Page.php");
//require_once(FRAMEWORK_PATH."data_objects/base/ProductPageData.php");

abstract class ProductPage extends Page
{
    protected $defaultPageDataClass = 'ProductPageData';
}
?>