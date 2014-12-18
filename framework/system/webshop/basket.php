<?php
require_once(FRAMEWORK_PATH."system/webshop/order.php");
require_once(FRAMEWORK_PATH."system/webshop/product.php");
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
require_once(FRAMEWORK_PATH."system/user/CMSUser.php");

/**
 * Class Basket
 */
class Basket extends Order
{
    public $table = 'fe_Baskets';
    public $tableItems = 'fe_BasketItems';

    public $id;
    public $user;
    public $itemsCount;
    public $totalPrice;
    public $createDate;
    public $updateDate;
    public $shippingAddressId;
    public $billingAddressId;
    public $items = array();
	protected $cacheKey;

    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Load minimal needed data: basket id, count of basket items...
     */
    public function __construct()
    {
        $this->user = CMSUser::getInstance();
		$this->cacheKey = $this->user->isLogged?"basket_guest_$this->id":'basket_'.$this->user->userId;

        /** if user logged in -  get basket id and items count*/
        if($this->user->userId !== NULL)
        {
            $this->loadBasket();

            /** if user logged in - check basketId from cookie, merge baskets, remove cookie */
            if(isset($_COOKIE['basketId']))
            {
                $this->mergeBaskets($this->id, $_COOKIE['basketId']);

            }
        }
        else
        {
            /** if user not logged - check cookie */
            if(isset($_COOKIE['basketId']))
            {
                $basketId = (int)$_COOKIE['basketId'];
                $this->loadGuestBasket($basketId);

                /** if basketId from cookie wrong - clear basketId from cookie */
                if($this->id == null)
                {
                    setcookie ("basketId", $this->id, time()-(60*60*24*30*12), "/", COOKIE_DOMAIN);
                }
            }
            else
            {
                $this->setProperties();
            }

        }


    }

    /**
     * Merge current logged in user basket with basket from cookie
     * @param $userBasketId
     * @param $guestBasketId
     * @return bool
     */
    private function mergeBaskets($userBasketId, $guestBasketId)
    {
        setcookie ("basketId", $this->id, time()-(60*60*24*30*12), "/", COOKIE_DOMAIN);

        /** Check if guest basket id available */
        $query = "SELECT id FROM {$this->table} WHERE id = {$guestBasketId} AND userId IS NULL";

        if(!Context::DB()->query($query))
        {
            return false;
        }

        if($userBasketId === NULL)
        {
            /** If user basket not exist - set guest basket for current user */
            $query = "UPDATE {$this->table} SET userId = {$this->user->userId}, billingAddressId = {$this->user->defaultAddressId}, shippingAddressId = {$this->user->defaultAddressId}  WHERE id = {$guestBasketId} AND userId IS NULL";

            if(Context::DB()->query($query))
            {
                $this->renew();
                return true;
            }

        }
        else
        {
            /** If user basket exist - merge user and guest baskets */
            $query = "UPDATE {$this->tableItems} SET pId = {$userBasketId} WHERE pId = {$guestBasketId}";

            if(Context::DB()->query($query))
            {
                $query = "DELETE FROM {$this->table} WHERE id = {$guestBasketId} AND userId IS NULL";

                if(Context::DB()->query($query))
                {
                    $this->renew();
                    return true;
                }
            }
        }

        $this->clearCache($userBasketId);
        $this->clearCache($guestBasketId);

        return false;
    }


    private function loadGuestBasket($basketId)
    {
        $cache = new CacheFace();
        if($data = $cache->get('basket_guest_'.$basketId))
        {
            $basket = unserialize($data);
            $this->setProperties($basket);
            return true;
        }

        $query = "SELECT * FROM fe_Baskets WHERE id = {$basketId} AND userId IS NULL";

        if(Context::DB()->query($query))
        {
            $basket = Context::DB()->result[0];
            $cache->save(serialize($basket));
            $this->setProperties($basket);
            return true;
        }
        $this->setProperties();
        return false;
    }

    private function loadBasket()
    {
        $cache = new CacheFace();

        if($data = $cache->get('basket_'.$this->user->userId))
        {
            $basket = unserialize($data);
            $this->setProperties($basket);
            return true;
        }

        $query = "SELECT * FROM fe_Baskets WHERE userId = {$this->user->userId}";

        if(Context::DB()->query($query))
        {
            $basket = Context::DB()->result[0];
            $cache->save(serialize($basket));
            $this->setProperties($basket);

            return true;
        }
        $this->setProperties();
        return false;
    }

    private function setProperties($data = array())
    {
        $default = array(
            'id' => null,
            'userId' => $this->user->userId,
            'itemsCount' => 0,
            'totalPrice' => 0,
            'createDate' => null,
            'updateDate' => null,
            'shippingAddressId' => null,
            'billingAddressId' => null
        );

        $data = array_merge($default, $data);

        $this->id = $data['id'];
//        $this->userId = $data['userId'];
        $this->itemsCount = $data['itemsCount'];
        $this->totalPrice = $data['totalPrice'];
        $this->createDate = $data['createDate'];
        $this->updateDate = $data['updateDate'];
        $this->shippingAddressId = $data['shippingAddressId'];
        $this->billingAddressId = $data['billingAddressId'];
        return true;
    }

    public function getProperties()
    {
        $data = array(
            'id' => $this->id,
            'userId' => $this->user->userId,
            'itemsCount' => $this->itemsCount,
            'totalPrice' => $this->totalPrice,
            'createDate' => $this->createDate,
            'updateDate' => $this->updateDate,
            'shippingAddressId' => $this->shippingAddressId,
            'billingAddressId' => $this->billingAddressId
        );

        return $data;
    }

    /**
     * Update basket after change basket items
     */
    public function renew()
    {
        $this->loadData();
        $this->calculate();
    }

    /**
     * Load user basket data and basket items data
     */
    public function loadData()
    {
        if($this->id == null) return false;

        $query = "  SELECT
                      b.id,
                      b.userId,
                      b.itemsCount,
                      b.totalPrice,
                      b.createDate,
                      b.updateDate,
                      b.shippingAddressId,
                      b.billingAddressId,
                      bi.id itemId,
                      bi.productId,
                      bi.variationId,
                      bi.quantity,
                      bi.pricePerProduct,
                      bi.amount
                    FROM
                      fe_Baskets b
                      LEFT JOIN fe_BasketItems bi
                        ON bi.pId = b.id
                    WHERE b.id = {$this->id}";

        if(Context::DB()->query($query))
        {
            $basket = Context::DB()->result;
            $this->setProperties($basket[0]);


            foreach ($basket as $item)
            {
                /** load detail of product variation */
                $productObject = Product::getInstance($item['productId']);

                $product = $productObject->getVariationById($item['variationId']);
                $photos = $productObject->photos;

                $this->items[$item['itemId']]['product'] = $product;
                $this->items[$item['itemId']]['photos'] = $photos;
                $this->items[$item['itemId']]['id'] = $item['itemId'];
                $this->items[$item['itemId']]['productId'] = $item['productId'];
                $this->items[$item['itemId']]['variationId'] = $item['variationId'];
                $this->items[$item['itemId']]['quantity'] = $item['quantity'];
                $this->items[$item['itemId']]['pricePerProduct'] = $item['pricePerProduct'];
                $this->items[$item['itemId']]['amount'] = $item['amount'];
                if (!empty($product['stock'])){
                    $this->items[$item['itemId']]['inStock'] = ($product['stock']  - $item['quantity'] >= 0);
                }
            }

        }
    }

    /**
     * Create user basket
     * @return bool
     * @throws CMSException
     */
    private function create()
    {
        $viewId = 1; /** @todo: needed change after created backend view */

        if (is_null($this->user->userId))
        {
            $query = "INSERT INTO {$this->table} (viewId, userId, createDate)
                      VALUES ({$viewId}, NULL, NOW())";
        }else{
            $query = "INSERT INTO {$this->table} (viewId, userId, createDate, billingAddressId, shippingAddressId)
                      VALUES ({$viewId}, {$this->user->userId}, NOW(), {$this->user->defaultAddressId}, {$this->user->defaultAddressId})";
        }


        if(Context::DB()->query($query))
        {
            $this->id = Context::DB()->LIID;
        }
        else
        {
            Context::Log(true, 'orders')->log("Order. Error create basket. userId: {$this->user->userId}");
            throw new CMSException("Order. Error create basket. userId: {$this->user->userId}");
        }

        /** if user not logged set cookie with basketId*/
        setcookie ("basketId", $this->id, time()+(60*60*24*30*12), "/", COOKIE_DOMAIN);
        return true;
    }

    public function update($table, $data)
    {
        Context::DB()->reset();
        foreach ($data as $name => $value)
        {
            Context::DB()->assign($name, $value);
        }

        Context::DB()->where_str = " id = " . $this->id;

        Context::DB()->update($table);

        $this->clearCache();

        return true;
    }

    /**
     * Calculate itemsCount, totalPrice of all basket items
     * and update basket
     */
    public function calculate()
    {
        $totalPrice = 0;
        $itemsCount = 0;

        foreach($this->items as $item)
        {
            if(!empty($item['inStock']) and $item['product']['visible'])
            {
                $totalPrice += $item['amount'];
            }

            $itemsCount += $item['quantity'];
        }

        $this->totalPrice = $totalPrice;
        $this->itemsCount = $itemsCount;
        $data = array();
        $data['itemsCount'] = $itemsCount;
        $data['totalPrice'] = $totalPrice;

        $this->update($this->table, $data);
    }

    /**
     * Add item to the user basket
     * @param $productId
     * @param $variationId
     * @param $quantity
     * @param $pricePerProduct
     * @return bool
     * @throws CMSException
     */
    public function addItem($productId, $variationId, $quantity, $pricePerProduct)
    {
        $updateItemId = null;
        /** if basket not created (not record in table fe_Baskets) - create it */
        if($this->id  == null)
        {
            $this->create();
        }
        else
        {
            /** if basket already exist - check if we add duplicate item */
            $query = "SELECT id, quantity
                      FROM {$this->tableItems}
                      WHERE pId = {$this->id} AND productId = {$productId} AND variationId = {$variationId}";

            if(Context::DB()->query($query))
            {
                $updateItemId = Context::DB()->result[0]['id'];
                $oldQuantity = Context::DB()->result[0]['quantity'];
            }
        }

        /** Inser*/
        if(is_null($updateItemId))
        {
            $amount = $pricePerProduct * $quantity;
            $query = "  INSERT INTO {$this->tableItems} (pId, productId, variationId, quantity, pricePerProduct, amount)
                        VALUES ({$this->id}, {$productId}, {$variationId}, {$quantity}, {$pricePerProduct}, {$amount})";

            if(!Context::DB()->query($query))
            {
                Context::Log(true, 'orders')->log("Order. Error add basket item. basketId: {$this->id}, userId: {$this->user->userId}, productId: {$productId}, variationId: {$variationId}, quantity: {$quantity}, pricePerProduct: {$pricePerProduct}");
                throw new CMSException("Order. Error add basket item.");
            }
        }
        /** Update basket item - because this product variation already added */
        else
        {
            $quantity = $oldQuantity + $quantity;
            if(!$this->updateItem($updateItemId, $quantity))
            {
                Context::Log(true, 'orders')->log("Order. Error update basket item. basketId: {$this->id}, userId: {$this->user->userId}, productId: {$productId}, variationId: {$variationId}, quantity: {$quantity}, pricePerProduct: {$pricePerProduct}");
                throw new CMSException("Order. Error update basket item.");
            }

        }

        $this->clearCache();

        $this->renew();

        return Context::DB()->LIID;
    }

    /**
     * Remove item from user basket
     * @param $itemId
     * @return bool
     */
    public function removeItem($itemId)
    {
        $itemId = (int)$itemId;
        $query = "DELETE FROM {$this->tableItems} WHERE pId = {$this->id} AND id = {$itemId}";
        if(Context::DB()->query($query))
        {
            $this->clearCache();
            $this->renew();
            return true;
        }
        return false;
    }

    /**
     * Update quantity, calculate and update amount
     * @param $itemId
     * @param $quantity
     * @return bool
     */
    public function updateItem($itemId, $quantity)
    {
        $itemId = (int)$itemId;

        $query = "  SELECT
                      pv.stock,
                      bi.pId
                    FROM
                      {$this->tableItems} bi
                      INNER JOIN fe_ProductVariations pv
                        ON pv.productId = bi.productId
                        AND pv.id = bi.variationId
                      WHERE bi.id = {$itemId}
                      AND bi.pId = {$this->id}";
        if(!Context::DB()->query($query))
        {
            return false;
        }

        $stock = Context::DB()->result[0]['stock'];

        $quantity = ($quantity > $stock)
            ? $stock
            : $quantity;

        $query = "  UPDATE {$this->tableItems} i
                    SET i.quantity = {$quantity}, i.amount = i.pricePerProduct * {$quantity}
                    WHERE i.id = {$itemId} AND i.pId = {$this->id}";

        if(Context::DB()->query($query))
        {
            $this->clearCache();
            $this->renew();
            return true;
        }
        return false;
    }

    /**
     * Create order from user basket
     * @param null $data - array of additional data: payment method, order status...
     * @return string
     * @throws CMSException
     */
    public function createOrder($data = null)
    {
        if(!$this->user->isLogged)
        {
            Context::Log(true, 'orders')->log("Order. Error create order. basketId: {$this->id}, userId: {$this->user->userId}");
            throw new CMSException("Order. Error create order. User is not logged in.");
        }

        /** 0. load basket data */
        $this->loadData();

        Context::DB()->reset();

        $orderId = ENVIRONMENT . "_" . $this->user->userId . "_" . time();

        Context::DB()->assign('orderId', $orderId);
        Context::DB()->assign('userId', $this->user->userId);
        Context::DB()->assign('itemsCount', $this->itemsCount);
        Context::DB()->assign('orderPrice', $this->totalPrice);
        Context::DB()->assign('totalPrice', $this->totalPrice + $this->getDeliveryPrice());
        Context::DB()->assign('deliveryPrice', $this->getDeliveryPrice());
        Context::DB()->assign('createDate', date('Y-m-d H:i:s'));
        Context::DB()->assign('shippingAddressId', $this->shippingAddressId);
        Context::DB()->assign('billingAddressId', $this->billingAddressId);


        /* set additional data */
        foreach ($data as $field => $value)
        {
            Context::DB()->assign($field, $value);
        }

        /** 1. insert new order  */
        if(!Context::DB()->insert('fe_Orders'))
        {
            Context::Log(true, 'orders')->log("Order. Error create order. basketId: {$this->id}, userId: {$this->user->userId}");
            throw new CMSException("Order. Error create order.");
        }

        $id = Context::DB()->LIID;

        /** 2. insert order items */
        foreach ($this->items as $item)
        {
            Context::DB()->reset();

            Context::DB()->assign('pId', $id);
            Context::DB()->assign('orderId', $orderId);
            Context::DB()->assign('productId', $item['productId']);
            Context::DB()->assign('variationId', $item['variationId']);
            Context::DB()->assign('quantity', $item['quantity']);
            Context::DB()->assign('pricePerProduct', $item['pricePerProduct']);
            Context::DB()->assign('amount', $item['amount']);

            if(!Context::DB()->insert('fe_OrderItems'))
            {
                Context::Log(true, 'orders')->log("Order. Error create order item. basketId: {$this->id}, orderId: {$orderId}, userId: {$this->user->userId}");
                throw new CMSException("Order. Error create order item.");
            }
        }


        /** 3. remove basket */
        $this->remove();

        return $orderId;
    }

    /**
     * Remove user basket
     * @return bool
     * @throws CMSException
     */
    private function remove()
    {
        $query = "DELETE FROM {$this->table} WHERE id = {$this->id}";

        if(!Context::DB()->query($query))
        {
            Context::Log(true, 'orders')->log("Order. Error remove basket. basketId: {$this->id}, userId: {$this->user->userId}");
            throw new CMSException("Order. Error remove basket.");
        }

        $this->clearCache();

        return true;
    }

    public function clearCache($basketId = null)
    {
        $basketId = is_null($basketId) ? $this->id : $basketId;

        $cache = new CacheFace();
        if(!$this->user->isLogged){
            $cache->removeByKey('basket_guest_'.$basketId);
        }else{
            $cache->removeByKey('basket_'.$this->user->userId);
        }

        return true;
    }

}