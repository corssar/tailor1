<?php

class OrderMask extends EventMask
{
    protected $orderId;

    function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getMask()
    {
        return array("{ORDER_ID}"=> WebText::getText("order_mask_id", "Order id"),
                     "{ORDER_STATUS}" => WebText::getText("order_mask_order_status", "Order status"),
                     "{PAYMENT_STATUS}" => WebText::getText("order_mask_payment_status", "Payment status"),
                     "{ORDER_PRICE}" => WebText::getText("order_mask_order_price", "Order price"),
                     "{ORDER_DELIVERY_PRICE}" => WebText::getText("order_mask_order_delivery_price", "Delivery price"),
                     "{ORDER_TOTAL_PRICE}" => WebText::getText("order_mask_order_total_price", "Total order price"),
                     "{ORDER_ITEMS_COUNT}" => WebText::getText("order_mask_order_items_count", "Order items count"),
                     "{ORDER_PAYMENT_METHOD}" => WebText::getText("order_mask_order_payment_method", "Payment method"),
                     "{NOTIFICATION_EMAIL_TEXT}" => WebText::getText("order_mask_notification_email_text", "Notification text"),
                     "{ORDER_USER_EMAIL}" => WebText::getText("order_mask_order_user_email", "Email of order owner"),
                     "{ORDER_USER_NAME}" => WebText::getText("order_mask_order_user_name", "Name of order owner"),
                     "{ORDER_USER_SURNAME}" => WebText::getText("order_mask_order_user_surname", "Surname of order owner"),
                     "{SHIPPING_ADDRESS}" => WebText::getText("order_mask_shipping_address", "Shipping address"),
                     "{BILLING_ADDRESS}" => WebText::getText("order_mask_billing_address", "Billing address")

//                     "{SHIPPING_COUNTRY}" => WebText::getText("order_mask_SHIPPING_COUNTRY", "Адреса доставки: країна"),
//                     "{SHIPPING_CITY}" => WebText::getText("order_mask_SHIPPING_CITY", "Адреса доставки: місто"),
//                     "{SHIPPING_STREET}" => WebText::getText("order_mask_SHIPPING_STREET", "Адреса доставки: вулиця"),
//                     "{SHIPPING_HOUSE_NUMBER}" => WebText::getText("order_mask_SHIPPING_HOUSE_NUMBER", "Адреса доставки: номер будинку"),
//                     "{SHIPPING_ZIP_CODE}" => WebText::getText("order_mask_SHIPPING_ZIP_CODE", "Адреса доставки: індекс"),
//                     "{SHIPPING_NAME}" => WebText::getText("order_mask_SHIPPING_NAME", "Адреса доставки: імя отримувача"),
//                     "{SHIPPING_SURNAME}" => WebText::getText("order_mask_SHIPPING_SURNAME", "Адреса доставки: прізвище отримувача"),
//                     "{SHIPPING_PHONE}" => WebText::getText("order_mask_SHIPPING_PHONE", "Адреса доставки: телефон"),
//                     "{BILLING_COUNTRY}" => WebText::getText("order_mask_BILLING_COUNTRY", "Адреса оплати: країна"),
//                     "{BILLING_CITY}" => WebText::getText("order_mask_BILLING_CITY", "Адреса оплати: місто"),
//                     "{BILLING_STREET}" => WebText::getText("order_mask_BILLING_STREET", "Адреса оплати: вулиця"),
//                     "{BILLING_HOUSE_NUMBER}" => WebText::getText("order_mask_BILLING_HOUSE_NUMBER", "Адреса оплати: номер будинку"),
//                     "{BILLING_ZIP_CODE}" => WebText::getText("order_mask_BILLING_ZIP_CODE", "Адреса оплати: індекс"),
//                     "{BILLING_NAME}" => WebText::getText("order_mask_BILLING_NAME", "Адреса оплати: імя платника"),
//                     "{BILLING_SURNAME}" => WebText::getText("order_mask_BILLING_SURNAME", "Адреса оплати: прізвище платника"),
//                     "{BILLING_PHONE}" => WebText::getText("order_mask_BILLING_PHONE", "Адреса оплати: телефон")
        );
    }

    public function replaceMask()
    {
        $order = null;
        if($this->orderId == null)
            return array();

        $order = new Order($this->orderId);

        if($order == null)
            return array();


        $shippingAddress  = $order->properties['shippingName'] . ' ' . $order->properties['shippingSurname'] . "<br/>";
        $shippingAddress .= $order->properties['shippingStreet'] . ' ' . $order->properties['shippingHouseNumber'] . "<br/>";
        $shippingAddress .= $order->properties['shippingZipCode'] . ' ' . $order->properties['shippingCity'] . "<br/>";
        $shippingAddress .= $order->properties['shippingCountry'] . "<br/>";
        $shippingAddress .= $order->properties['shippingPhoneNumber'] . "<br/>";

        $billingAddress  = $order->properties['billingName'] . ' ' . $order->properties['billingSurname'] . "<br/>";
        $billingAddress .= $order->properties['billingStreet'] . ' ' . $order->properties['billingHouseNumber'] . "<br/>";
        $billingAddress .= $order->properties['billingZipCode'] . ' ' . $order->properties['billingCity'] . "<br/>";
        $billingAddress .= $order->properties['billingCountry'] . "<br/>";
        $billingAddress .= $order->properties['billingPhoneNumber'] . "<br/>";

        return array("{ORDER_ID}" => $order->properties['orderId'],
                     "{ORDER_STATUS}" => $order->properties['orderStatus'],
                     "{PAYMENT_STATUS}" => $order->properties['paymentStatus'],
                     "{ORDER_PRICE}" => $order->properties['orderPrice'],
                     "{ORDER_DELIVERY_PRICE}" => $order->properties['deliveryPrice'],
                     "{ORDER_TOTAL_PRICE}" => $order->properties['totalPrice'],
                     "{ORDER_ITEMS_COUNT}" => $order->properties['itemsCount'],
                     "{ORDER_PAYMENT_METHOD}" => $order->properties['paymentMethod'],
                     "{NOTIFICATION_EMAIL_TEXT}" => '',
                     "{ORDER_USER_EMAIL}" => $order->properties['userEmail'],
                     "{ORDER_USER_NAME}" => $order->properties['userName'],
                     "{ORDER_USER_SURNAME}" => $order->properties['userSurname'],
                     "{SHIPPING_ADDRESS}" => $shippingAddress,
                     "{BILLING_ADDRESS}" => $billingAddress

//                     "{SHIPPING_COUNTRY}" => $order->properties['shippingCountry'],
//                     "{SHIPPING_CITY}" => $order->properties['shippingCity'],
//                     "{SHIPPING_STREET}" => $order->properties['shippingStreet'],
//                     "{SHIPPING_HOUSE_NUMBER}" => $order->properties['shippingHouseNumber'],
//                     "{SHIPPING_ZIP_CODE}" => $order->properties['shippingZipCode'],
//                     "{SHIPPING_NAME}" => $order->properties['shippingName'],
//                     "{SHIPPING_SURNAME}" => $order->properties['shippingSurname'],
//                     "{SHIPPING_PHONE}" => $order->properties['shippingPhoneNumber'],
//                     "{BILLING_COUNTRY}" => $order->properties['billingCountry'],
//                     "{BILLING_CITY}" => $order->properties['billingCity'],
//                     "{BILLING_STREET}" => $order->properties['billingStreet'],
//                     "{BILLING_HOUSE_NUMBER}" => $order->properties['billingHouseNumber'],
//                     "{BILLING_ZIP_CODE}" => $order->properties['billingZipCode'],
//                     "{BILLING_NAME}" => $order->properties['billingName'],
//                     "{BILLING_SURNAME}" => $order->properties['billingSurname'],
//                     "{BILLING_PHONE}" => $order->properties['billingPhoneNumber']
        );

    }

    public function getMaskName()
    {
        return WebText::getText("order_mask_group_name", "Замовлення");
    }
}