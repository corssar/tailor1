<?php
if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once(FRAMEWORK_PATH."system/webshop/order.php");
require_once(FRAMEWORK_PATH."core/OrderPage.php");
require_once FRAMEWORK_PATH.'system/cache/CacheFace.php';
/*require_once FRAMEWORK_PATH.'system/webshop/basket.php';*/
require_once FRAMEWORK_PATH.'system/addresses.php';
require_once FRAMEWORK_PATH.'system/appUrl.php';
require_once FRAMEWORK_PATH.'system/helper/LinkManager.php';
require_once FRAMEWORK_PATH.'system/user/CMSUser.php';
/*require_once FRAMEWORK_PATH.'system/webshop/payments/PaymentProvidersFactory.php';*/


class OrderModerationPreview extends OrderPage
{
    protected $template = 'Pages/sb_overview.tpl';
    protected $JS = array("/frontend/webcontent/js/orderModeration.js");

    const billingShippingViewId = 136;

    public function load()
    {
        $this->templateData = array();

        $this->pageData = new OrderPageData($this->getPageId());

        $orderId = Order::getOrderIdById($this->getPageId());
        $orderObject = new Order($orderId);
        $orderObject->loadOrderData();




        $order = $orderObject->properties;
        $order['items'] = $orderObject->items;

        foreach ($order['items'] as $key => $item)
        {
            if (!empty($order['items'][$key]['product']['codeName'])){
                $order['items'][$key]['product']['url'] = appUrl::getUrlByCode($order['items'][$key]['product']['codeName'], 'product.php');
            }
        }
        $this->templateData['basket'] = $order;
        $this->templateData['orderStatus'] = $orderObject->getOrderStatusTitle();

        $this->templateData['deliveryPrice'] = $order['deliveryPrice'];

        $this->templateData['totalSum'] = $order['totalPrice'];

        $address = new Addresses();

        $this->templateData['billing'] = $address->get($order['billingAddressId'], $order['userId']);
        $this->templateData['shipping'] = $address->get($order['shippingAddressId'], $order['userId']);

        $this->templateData['changeAddressesUrl'] = LinkManager::GetSystemPageUrl(self::billingShippingViewId);

        $this->templateData['paymentMethod'] = PaymentProvidersFactory::getMethodById($order['paymentMethodId']);

        $this->templateData['isModeration'] = true;

        return $this->templateData;
    }
}
$newPage = new OrderModerationPreview();
$newPage->run();