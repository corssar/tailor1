<?php
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
require_once(FRAMEWORK_PATH."system/webshop/basket.php");
require_once(FRAMEWORK_PATH."system/webshop/product.php");
require_once(FRAMEWORK_PATH."system/tpl_engine/SmartyView.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");
require_once(FRAMEWORK_PATH."system/webshop/payments/PaymentProvidersFactory.php");

class webshopController
{

    public static function addToBasket()
    {
        $productId = Request::getInt('productId',"POST");
        $variationId = Request::getInt('variationId',"POST");
        $quantity = 1;

        $product = Product::getInstance($productId);
        $variation = $product->getVariationById($variationId);

        if(empty($variation))
        {
            return array('success' => false);
        }

        try {
            $basket = Basket::getInstance();
            $basket->addItem($productId, $variationId, $quantity, $variation['price']);
        } catch (Exception $e) {
            return array('success' => false);
        }

        return array('success' => true);
    }

    private function loadBasketData($basketObject)
    {
        $basket = $basketObject->getProperties();
        $basket['items'] = $basketObject->items;

        foreach ($basket['items'] as $key => $item)
        {
            if (!empty($basket['items'][$key]['product']['codeName'])){
                $basket['items'][$key]['product']['url'] = appUrl::getUrlByCode($basket['items'][$key]['product']['codeName'], 'product.php');
            }
        }

        $templateData['basket'] = $basket;

        $deliveryPrice = $basketObject->getDeliveryPrice();
        $templateData['deliveryPrice'] = $deliveryPrice;

        /** if totalPrice = 0 then not sum delivery price */
        $templateData['totalSum'] = ($basket['totalPrice'] != 0)
            ? $basket['totalPrice'] + $deliveryPrice
            : 0;

        $smarty = new SmartyView();

        return $smarty->fetch(FRONTEND_TEMPL_PATH.'PageObjects/shoppingbagTable.tpl', $templateData);
    }

//    public function loadOrderData()
//    {
//        $orderId = Request::getInt('id',"POST");
//
//        $user = CMSUser::getInstance();
//        if($user->isLogged === false)
//        {
//            return array('success' => false);
//        }
//
//        $orderObject = new Order($orderId, $user->userId);
//
//        $basket['items'] = $orderObject->items;
//
//        foreach ($basket['items'] as $key => $item)
//        {
//            if (!empty($basket['items'][$key]['product']['codeName'])){
//                $basket['items'][$key]['product']['url'] = appUrl::getUrlByCode($basket['items'][$key]['product']['codeName'], 'product.php');
//            }
//        }
//
//        $templateData['basket'] = $basket;
//
//        $deliveryPrice = $orderObject->getDeliveryPrice();
//        $templateData['deliveryPrice'] = $deliveryPrice;
//
//        /** if totalPrice = 0 then not sum delivery price */
//        $templateData['totalSum'] = ($basket['totalPrice'] != 0)
//            ? $basket['totalPrice'] + $deliveryPrice
//            : 0;
//
//        $smarty = new SmartyView();
//
//        $orderDetail = $smarty->fetch(FRONTEND_TEMPL_PATH.'PageObjects/orderTable.tpl', $templateData);
//
//        return array('success' => true, 'data' => $orderDetail);
//    }

    public function removeBasketItem()
    {
        $itemId = Request::getInt('itemId',"POST");

        $basket = Basket::getInstance();
        if(!$basket->removeItem($itemId))
        {
            return array('success' => false);
        }

        $data = $this->loadBasketData($basket);

        return array('success' => true, 'table' => $data, 'itemsCount' => $basket->itemsCount);
    }

    public function changeBasketItemQuantity()
    {
        $itemId = Request::getInt('itemId',"POST");
        $quantity = Request::getInt('quantity',"POST");

        $basket = Basket::getInstance();
        if(!$basket->updateItem($itemId, $quantity))
        {
            return array('success' => false);
        }

        $data = $this->loadBasketData($basket);

        return array('success' => true, 'table' => $data, 'itemsCount' => $basket->itemsCount);
    }

    private function saveAddress($address)
    {
        $user = CMSUser::getInstance();
        $addressObj = new Addresses();

        /** if address is changed */
        if($address['isChanged'] == 'true')
        {
            if($user->defaultAddressId == $address['id'] or isset($address['add']) and $address['add'] == 1 )
            {
                /** if changed default user address then needed insert new address, do not change default user address! */
                $result = $addressObj->add(ReservedRequestData::shortAddress($address));
                if(!$result)
                {
                    $this->validationErrors = $addressObj->validationErrors;
                    return false;
                }

            }
            else
            {
                $result = $addressObj->update($address['id'], ReservedRequestData::shortAddress($address));
                if(!$result)
                {
                    $this->validationErrors = $addressObj->validationErrors;
                    return false;
                }
            }
        }

        return $address['id'];
    }

    public function addBillingShippingAddresses()
    {
        $billing = $_POST['billing'];
        $basket = Basket::getInstance();

        $billingAddressId = $this->saveAddress($billing);
        if($billingAddressId === false)
        {
            return array('success' => false, 'validationErrors' => $this->validationErrors);
        }


        /** change basket address id */
        if($billingAddressId > 0 and $billingAddressId !== true)
        {
            $basket->update($basket->table, array('billingAddressId' => $billingAddressId));
        }


        /** if shipping address = billing address */
        if($_POST['address-copy'] == 1)
        {
            /** change basket shipping address id to billing id*/
            $basket->update($basket->table, array('shippingAddressId' => $billingAddressId));
        }
        else
        {
            $shipping = $_POST['shipping'];

            /** if billing and shipping addresses id equal  and shipping is changed then need create new shipping address */
            if($billing['id'] == $shipping['id'] and $shipping['isChanged'] == 'true')
            {
                $shipping['add'] = 1;
            }

            $shippingAddressId = $this->saveAddress($shipping);
            if($shippingAddressId === false)
            {
                return array('success' => false, 'validationErrors' => $this->validationErrors);
            }

            /** change basket shipping address id */
            if($shippingAddressId > 0 and $shippingAddressId !== true)
            {
                $basket->update($basket->table, array('shippingAddressId' => $shippingAddressId));
            }

        }

        /** url for next step */
        $url = LinkManager::GetSystemPageUrl(137); // Shopping bag overview
        return array('success' => true, 'url' => $url);
    }

    public function createOrder()
    {
        /** 1. @todo: check stock */


        /** 2. create order + return form */
        $paymentMethodId = Request::getInt('paymentMethod');

        $methods = PaymentProvidersFactory::getMethods();

        foreach($methods as $item)
        {
            if($item['id'] == $paymentMethodId){
                $paymentMethod = $item['code'];
                $paymentProviderId = $item['providerId'];
                break;
            }
        }

        $basket = Basket::getInstance();

        $data = array();
        $data['paymentMethodId'] = $paymentMethodId;
        $data['paymentMethod'] = $paymentMethod;
        $data['orderStatusId'] = OrderStatus::$inprogress;

        $orderId = $basket->createOrder($data);

        $providerConfig = PaymentProvidersFactory::getProviderById($paymentProviderId);
        require_once(FRAMEWORK_PATH."system/webshop/payments/{$providerConfig['className']}.php");
        $provider = new $providerConfig['className']($providerConfig);

        $code = $provider->getForm($orderId, $paymentMethod);

        return array('success' => true, 'html' => $code);
    }
}
