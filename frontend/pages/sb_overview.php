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
require_once FRAMEWORK_PATH.'system/webshop/payments/PaymentProvidersFactory.php';


class SbOverview extends Page
{
    protected $template = 'Pages/sb_overview.tpl';
    protected   $requireAuthorization = true;
    protected $JS = array("/frontend/webcontent/js/webshop.js");

    const billingShippingViewId = 136;

    public function load()
    {
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
            $this->templateData['title'] = $this->pageData->getValue('title');
        }

        $basketObject = Basket::getInstance();

        $basketObject->loadData();

        $basket = $basketObject->getProperties();
        $basket['items'] = $basketObject->items;

        foreach ($basket['items'] as $key => $item)
        {
            if (!empty($basket['items'][$key]['product']['codeName'])){
                $basket['items'][$key]['product']['url'] = appUrl::getUrlByCode($basket['items'][$key]['product']['codeName'], 'product.php');
            }
        }
        $this->templateData['basket'] = $basket;

        $deliveryPrice = $basketObject->getDeliveryPrice();
        $this->templateData['deliveryPrice'] = $deliveryPrice;

        /** if totalPrice = 0 then not sum delivery price */
        $this->templateData['totalSum'] = ($basket['totalPrice'] != 0)
            ? $basket['totalPrice'] + $deliveryPrice
            : 0;

        $address = new Addresses();

        $this->templateData['billing'] = $address->get($basketObject->billingAddressId);
        $this->templateData['shipping'] = $address->get($basketObject->shippingAddressId);

        $this->templateData['changeAddressesUrl'] = LinkManager::GetSystemPageUrl(self::billingShippingViewId);

        $this->templateData['paymentMethods'] = PaymentProvidersFactory::getMethods();

        $this->templateData['isModeration'] = false;

        return $this->templateData;
    }
}
$newPage = new SbOverview();
$newPage->run();