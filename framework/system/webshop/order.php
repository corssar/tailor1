<?php
require_once(FRAMEWORK_PATH."system/CMSException.php");

class OrderStatus
{
    static $new = 1;
    static $waitingToDelivery = 2;
    static $shipped = 3;
    static $closed = 4;
    static $returned = 5;
    static $canceled = 6;
}

class PaymentStatus
{
    static $inProgress = 1;
    static $success = 2;
    static $fail = 3;
}

class Order
{
    public $id = null;
    public $userId;
    public $itemsCount;
    public $totalPrice;
    private $orderStatusId;
    private $paymentStatusId;
    private $paymentMethodId;
    public $items = array();
    public $properties = array();

    private $table = 'fe_Orders';
    private $tableItems = 'fe_OrderItems';

    public $statuses = array();

    public function __construct($orderId, $userId = NULL)
    {
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->getData();
        $this->statuses = $this->getOrderStatuses();
    }


    private function getData()
    {

        $query = "SELECT
                      o.*,
                      u.email userEmail, u.name userName, u.surname userSurname,
                      ost.title orderStatus,
                      pst.title paymentStatus,
                      sa.countryName shippingCountry, sa.cityName shippingCity, sa.street shippingStreet,
                      sa.houseNumber shippingHouseNumber, sa.zipCode shippingZipCode, sa.name shippingName,
                      sa.surname shippingSurname, sa.phoneNumber shippingPhoneNumber, sa.gender shippingGender,
                      ba.countryName billingCountry, ba.cityName billingCity, ba.street billingStreet,
                      ba.houseNumber billingHouseNumber, ba.zipCode billingZipCode, ba.name billingName,
                      ba.surname billingSurname, ba.phoneNumber billingPhoneNumber, ba.gender billingGender
                    FROM
                      fe_Orders o
                      INNER JOIN fe_Users u ON u.id = o.userId
                      LEFT JOIN fe_OrderStatusTranslations ost ON ost.langId = u.langId AND ost.statusId = o.orderStatusId
                      LEFT JOIN fe_PaymentStatusTranslations pst ON pst.langId = u.langId AND pst.statusId = o.paymentStatusId
                      LEFT JOIN fe_Addresses sa ON sa.id = o.shippingAddressId
                      LEFT JOIN fe_Addresses ba ON ba.id = o.billingAddressId
                    WHERE o.orderId = '{$this->orderId}'";

        if($this->userId !== NULL)
        {
            $query = $query . " AND o.userId = {$this->userId}";
        }

        if(Context::DB()->query($query))
        {
            $result = Context::DB()->result[0];
            $this->userId = $result['userId'];
            foreach($result as $key => $value)
            {
                $this->properties[$key] = $value;
            }
        }
        else
        {
            Context::Log(true, 'orders')->log("Order. Wrong params orderId: {$this->orderId}, userId: {$this->userId}. $query");
            throw new CMSException("Order. Wrong params orderId: {$this->orderId}, userId: {$this->userId}");
        }

        $query = "SELECT * FROM {$this->tableItems} WHERE orderId = '{$this->orderId}'";

        if(Context::DB()->query($query))
        {
            $result = Context::DB()->result;
            foreach($result as $key => $value)
            {
                $this->items[$value['id']] = $value;
            }

        }

        return $this->items;
    }

    public function setOrderStatus($statusId)
    {
        $query = "UPDATE fe_Orders SET orderStatusId = {$statusId} WHERE orderId = '{$this->orderId}'";
        if(Context::DB()->query($query))
        {
            Context::Log(true, 'orders')->log("Change order status. userId: {$this->userId}, orderId: {$this->orderId}, statusId: {$statusId}");
            $this->orderStatusId = $statusId;
            return true;
        }

        Context::Log(true, 'orders')->log("Error change order status. userId: {$this->userId}, orderId: {$this->orderId}, statusId: {$statusId}");
    }

    public function setPaymentStatus($statusId)
    {
        $query = "UPDATE fe_Orders SET paymentStatusId = {$statusId} WHERE orderId = '{$this->orderId}'";
        if(Context::DB()->query($query))
        {
            Context::Log(true, 'orders')->log("Change payment status. userId: {$this->userId}, orderId: {$this->orderId}, statusId: {$statusId}");
            $this->paymentStatusId = $statusId;
            return true;
        }

        Context::Log(true, 'orders')->log("Error change payment status. userId: {$this->userId}, orderId: {$this->orderId}, statusId: {$statusId}");
    }

    public function getOrderStatus()
    {
        return $this->orderStatusId;
    }

    public function getOrderStatusTitle()
    {
        $q = "SELECT title FROM fe_OrderStatusTranslations WHERE statusId = ".$this->properties['orderStatusId']." AND langId = ".Context::LanguageId();
        if(Context::DB()->query($q))
            return Context::DB()->result[0]['title'];

        return false;
    }

    public function getPaymentStatus()
    {
        return $this->paymentStatusId;
    }

    public function getDeliveryPrice()
    {
        /** @todo: delivery need get from settings or etc */
        return 19.04;
    }

    public static function getUserOrders()
    {
        $user = CMSUser::getInstance();

        $sql = "SELECT o.*, ost.title orderStatus
                FROM fe_Orders o
                INNER JOIN fe_OrderStatusTranslations ost ON ost.statusId = o.orderStatusId AND langId = ".Context::LanguageId()."
                WHERE userId = ".$user->userId."
                ORDER BY createDate DESC";

        if(Context::DB()->query($sql))
        {
            return Context::DB()->result;
        }

        return array();
    }

    public static function getOrderIdById($id)
    {
        $q = "SELECT orderId FROM fe_Orders WHERE id = ".$id;
        if(Context::DB()->query($q))
            return Context::DB()->result[0]['orderId'];

        return false;
    }

    public function loadOrderData()
    {
        foreach ($this->items as $key=>$item)
        {
            /** load detail of product variation */
            require_once(FRAMEWORK_PATH."system/webshop/product.php");
            $productObject = Product::getInstance($item['productId']);

            $product = $productObject->getVariationById($item['variationId']);
            $photos = $productObject->photos;

            $this->items[$key]['product'] = $product;
            $this->items[$key]['photos'] = $photos;
            /*$this->items[$item['itemId']]['id'] = $item['itemId'];
            $this->items[$item['itemId']]['productId'] = $item['productId'];
            $this->items[$item['itemId']]['variationId'] = $item['variationId'];
            $this->items[$item['itemId']]['quantity'] = $item['quantity'];
            $this->items[$item['itemId']]['pricePerProduct'] = $item['pricePerProduct'];
            $this->items[$item['itemId']]['amount'] = $item['amount'];
            if (!empty($product['stock'])){
                $this->items[$item['itemId']]['inStock'] = ($product['stock']  - $item['quantity'] >= 0);
            }*/
        }
    }

    public function getOrderStatuses()
    {
        require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
        $cache = new CacheFace();
        $statuses = array();
        if(($data = $cache->get('order_statuses_'.Context::LanguageId())) !== false){
            $statuses = unserialize($data);
        }
        else{
            $query = "  SELECT
                                fe_OrderStatus.id statusId,
                                fe_OrderStatus.description,
                                fe_OrderStatusTranslations.title
                            FROM
                                fe_OrderStatus
                            INNER JOIN
                                    fe_OrderStatusTranslations
                                ON
                                    fe_OrderStatusTranslations.statusId = fe_OrderStatus.id
                            WHERE
                                fe_OrderStatusTranslations.langId = ".Context::LanguageId();
            Context::DB()->query($query);

            foreach(Context::DB()->result as $status){
                $statuses[$status['statusId']] = $status;
            }
            $cache->save(serialize($statuses));
        }
        return $statuses;
    }

    public function getOrderPaymentStatuses()
    {
        require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
        $cache = new CacheFace();
        $pStatuses = array();
        if(($data = $cache->get('order_payment_statuses_'.Context::LanguageId())) !== false){
            $pStatuses = unserialize($data);
        }
        else{
            $query = "  SELECT
                                fe_PaymentStatus.id pStatusId,
                                fe_PaymentStatus.description,
                                fe_PaymentStatusTranslations.title
                            FROM
                                fe_PaymentStatus
                            INNER JOIN
                                    fe_PaymentStatusTranslations
                                ON
                                    fe_PaymentStatusTranslations.statusId = fe_PaymentStatus.id
                            WHERE
                                fe_PaymentStatusTranslations.langId = ".Context::LanguageId();
            Context::DB()->query($query);

            foreach(Context::DB()->result as $pStatus){
                $pStatuses[$pStatus['pStatusId']] = $pStatus;
            }
            $cache->save(serialize($pStatuses));
        }
        return $pStatuses;
    }

}