<?php

class OrderStatusEvent extends EventBase
{
    protected $statusCode;
    protected $orderId;
    public $userId;

    function __construct($statusCode = null, $orderId = null, $userId = null)
    {
        $this->statusCode = $statusCode;
        $this->orderId = $orderId;
        $this->userId = $userId;
    }

    public function getEventName()
    {
        return WebText::getText("order_status_{$this->statusCode}", "Зміна статусу замовлення {$this->statusCode}");
    }

    public function getEventMasks()
    {
        return array(new UserMask($this->userId), new OrderMask($this->orderId), new SiteSettingMask());
    }

    public function getEventCode()
    {
        return "order_status_{$this->statusCode}";
    }
}