<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once(FRAMEWORK_PATH."system/webshop/order.php");

class MyOrders extends Page
{
    protected $template = 'Pages/myorders.tpl';
    protected $requireAuthorization = true;
    protected $JS = array("/frontend/webcontent/js/webshop.js");

    public function load()
    {

        $data = new PageData($this->getPageId());
        if(!$data->load())
            throw new CMSExeption("Data for content page was not loaded. Pageid=".$this->getPageId());

        $pageData['title'] = $data->getValue('title');
        if($data->getValue('introHtml'))
        {
            $pageData['introHtml'] = appUrl::CMSConstantsToValues($data->getValue('introHtml'));
        }

        $pageData['orders'] = Order::getUserOrders();

        return $pageData;
    }
}
$newPage = new MyOrders();
$newPage->run();
