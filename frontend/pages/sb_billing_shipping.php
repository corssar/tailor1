<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/addresses.php';
require_once FRAMEWORK_PATH.'system/webshop/basket.php';


class SbBillingShipping extends Page
{
    protected $template = 'Pages/sb_billing_shipping.tpl';
    protected $requireAuthorization = true;

    protected 	$CSS = array("/frontend/webcontent/js/jquery-ui/css/jquery-ui.css");

    protected 	$JS = array("/frontend/webcontent/js/jquery-ui/js/jquery-ui.min.js",
        "/frontend/webcontent/js/jquery-ui/js/jquery-ui-i18n.js",
        "/frontend/webcontent/js/jquery.form.js",
        "/frontend/webcontent/js/webshop.js");

    public function load()
    {
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
            $this->templateData['title'] = $this->pageData->getValue('title');

        }

        $address = new Addresses();
        $basket = Basket::getInstance();

        if($basket->billingAddressId == null)
        {
            $this->templateData['billing'] = $address->get($address->user->defaultAddressId);
        }
        else
        {
            $this->templateData['billing'] = $address->get($basket->billingAddressId);
        }

        $this->templateData['shipping'] = $address->get($basket->shippingAddressId);

        if($basket->billingAddressId != $basket->shippingAddressId)
        {

        }

        return $this->templateData;
    }


}

$newPage = new SbBillingShipping();
$newPage->run();