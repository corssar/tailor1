<?php

class PaymentSuccessEvent extends EventBase
{
    protected $orderId;
    public $userId;

    function __construct($orderId = null, $userId = null)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
    }

    public function getEventName()
    {
        return WebText::getText("payment_success_event_name", "Успішна оплата замовлення");
    }

    public function getEventMasks()
    {
        return array(new OrderMask($this->orderId), new SiteSettingMask(), new UserMask($this->userId));
    }
}