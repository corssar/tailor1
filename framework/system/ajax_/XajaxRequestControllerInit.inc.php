<?php

require_once(FRONTEND_PATH."/vendors/xajax05/xajax_core/xajax.inc.php");

require_once(FRAMEWORK_PATH."/system/ajax/XajaxRequestController.php");


$xajaxInstance = XajaxRequestController::getXajaxInstance();
/*@var $xajaxInstance xajax*/
$xajaxInstance->configure('javascript URI', SITE_PROTOCOL.Context::SiteSettings()->getSiteUrl()."/frontend/vendors/xajax05/");

$xajaxRequestControllerFunctionRef = &XajaxRequestController::getInstance();

//$xajaxInstance->registerFunction(array("doRequest",&$xajaxRequestControllerFunctionRef,"doRequest"));
$xajaxInstance->register(XAJAX_FUNCTION,array("doRequest",&$xajaxRequestControllerFunctionRef,"doRequest"));


$xajaxInstance->processRequest();

?>