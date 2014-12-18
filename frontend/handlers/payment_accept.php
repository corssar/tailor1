<?php

if(file_exists('../../config.php'))
    require_once '../../config.php';
require_once FRAMEWORK_PATH.'system/webshop/order.php';


$payStatus = $_REQUEST['STATUS'];
//Status 9 is success for PAYPAL and 5 is authorized for CREDIT CARD
$payId = $_REQUEST['PAYID'];
$payTypes = $_REQUEST['BRAND'];
$payIPAddress = $_REQUEST['IP'];
$payType = $_REQUEST['PM'];
$amount = $_REQUEST['AMOUNT'];
$invoiceNumber = $_REQUEST['orderID'];


Context::Log(true, 'orders.request')->log(json_encode($_REQUEST));

/** @todo: save data from payment provider to database */



$order = new Order($invoiceNumber);

if($payStatus == '9' || $payStatus == '5')
{
    $order->setOrderStatus(OrderStatus::$paid);
}
else
{
    $order->setOrderStatus(OrderStatus::$canceled);
}