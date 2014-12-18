<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."core/Page.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
require_once FRAMEWORK_PATH.'system/webshop/basket.php';
require_once FRAMEWORK_PATH.'system/appUrl.php';
require_once FRAMEWORK_PATH.'system/helper/LinkManager.php';
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';

class Shoppingbag extends Page
{
    protected $template = 'Pages/shoppingbag.tpl';
    protected $JS = array("/frontend/webcontent/js/webshop.js");
    protected $CSS = array("/frontend/webcontent/css/content.css");

    const loginViewId = 135;
    const billingShippingViewId = 136;

    public function load()
    {
        $this->templateData = array();
        $this->pageData = new PageData($this->getPageId());

        if($this->pageData->load())
        {
            $this->templateData['title'] = $this->pageData->getValue('title');

            $user = CMSUser::getInstance();
            $this->templateData['isLogged'] = $user->isLogged;


            if($user->isLogged)
            {
                $this->templateData['checkoutUrl'] = LinkManager::GetSystemPageUrl(self::billingShippingViewId);
            }
            else
            {
                $this->templateData['checkoutUrl'] = LinkManager::GetSystemPageUrl(self::loginViewId);
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

        }

        return $this->templateData;
    }
}
$newPage = new Shoppingbag();
$newPage->run();