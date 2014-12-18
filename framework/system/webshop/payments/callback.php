<?php
require_once '../../../../config.php';

// this code needed test on real domain, not localhost!

if (isset($_GET['id'])){

    $id = (int)$_GET['id'];
    $providerConfig = PaymentProvidersFactory::getProviderById($id);
    $payment = new $providerConfig['className']($providerConfig);

    // verify request data, change status of order, echo response
    $payment->processRequest();
    exit();
}
