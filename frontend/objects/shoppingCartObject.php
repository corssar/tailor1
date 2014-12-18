<?php
require_once(FRAMEWORK_PATH."core/PageObject.php");
require_once(FRAMEWORK_PATH."system/webshop/basket.php");

class shoppingCartObject extends PageObject
{
    private $shoppingbagViewId = 134;
    public function loadPageObject()
    {
        $poData = new PageObjectData($this->poId);
        if($poData->load())
        {
            if($poData->getValue('title'))
            {
                $this->pageObjectData['cartTitle'] = $poData->getValue('title');
            }

            $basket = Basket::getInstance();

            $this->pageObjectData['productsAmount'] = $basket->itemsCount;
            $basket->loadData();
            $itemsForPopUp = array();
            foreach($basket->items as $item){
                array_push($itemsForPopUp, array('photo' => $item['photos'][0]['imageSmall'], 'title' => $item['product']['title']));
            }

            $this->pageObjectData['itemsForPopUp'] = json_encode($itemsForPopUp);
            $this->pageObjectData['shoppingbagUrl'] = LinkManager::GetSystemPageUrl($this->shoppingbagViewId);

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

            $this->pageObjectData['basket'] = $basket;

            $deliveryPrice = $basketObject->getDeliveryPrice();
            $this->pageObjectData['deliveryPrice'] = $deliveryPrice;

            /** if totalPrice = 0 then not sum delivery price */
            $this->pageObjectData['totalSum'] = ($basket['totalPrice'] != 0)
                ? $basket['totalPrice'] + $deliveryPrice
                : 0;

            $this->setTemplate('templates/PageObjects/shoppingCartObject_new.tpl');

        }
        else
        {
            return false;
        }

        return true;
    }
}
