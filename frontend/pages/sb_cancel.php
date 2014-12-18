<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once FRAMEWORK_PATH.'system/webshop/basket.php';
require_once FRAMEWORK_PATH.'system/addresses.php';
require_once FRAMEWORK_PATH.'system/appUrl.php';
require_once FRAMEWORK_PATH.'system/helper/LinkManager.php';
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';


class SbCancel extends Page
{
    protected $template = 'Pages/sb_cancel.tpl';

    public function load()
    {
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
//            $order = new Order(Request::getString('orderId'));
//            $order->setOrderStatus(4);
            $this->templateData['title'] = $this->pageData->getValue('title');
            $this->templateData['text'] = $this->pageData->getValue('introHtml');
            $this->templateData['homeUrl'] = SITE_PROTOCOL . SiteSettings::getSiteUrl();
        }

        return $this->templateData;
    }
}
$newPage = new SbCancel();
$newPage->run();