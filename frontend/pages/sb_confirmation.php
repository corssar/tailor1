<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once FRAMEWORK_PATH.'system/webshop/basket.php';
require_once FRAMEWORK_PATH.'system/SiteSettings.php';


class SbConfirmation extends Page
{
    protected $template = 'Pages/sb_confirmation.tpl';
    protected   $requireAuthorization = true;
//    protected $JS = array("/frontend/webcontent/js/webshop.js");

    public function load()
    {
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
            /*$order = new Order(Request::getString('orderId'));
            $order->setOrderStatus(3);*/

            $this->templateData['title'] = $this->pageData->getValue('title');
            $this->templateData['text'] = $this->pageData->getValue('introHtml');
            $this->templateData['homeUrl'] = SITE_PROTOCOL . SiteSettings::getSiteUrl();
        }

        return $this->templateData;
    }
}
$newPage = new SbConfirmation();
$newPage->run();