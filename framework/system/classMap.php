<?php
include_once FRAMEWORK_PATH. "system/autoLoad.php";
spl_autoload_register(array('AutoLoader' , 'load'));

Autoloader::registerPath(FRAMEWORK_PATH . "/system/cache/");
Autoloader::registerPath(FRAMEWORK_PATH . "/core/");
Autoloader::registerPath(FRAMEWORK_PATH . "/core/base/");
Autoloader::registerPath(FRAMEWORK_PATH . "/custom/");
Autoloader::registerPath(FRAMEWORK_PATH . "/data_objects/");
Autoloader::registerPath(FRAMEWORK_PATH . "/data_objects/base/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/helper/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/helper/base/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/Event/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/Event/Masks/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/search/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/user/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/tpl_engine/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/webshop/");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/webshop/payments");
Autoloader::registerPath(FRAMEWORK_PATH . "/system/social_user/");
Autoloader::registerPath(FRONTEND_PATH . "/handlers/");
Autoloader::registerPath(FRONTEND_PATH . "/objects/");
Autoloader::registerPath(SITE_PATH."vendors/sfacet/");
Autoloader::registerPath(SITE_PATH."vendors/ses/");
Autoloader::registerPath(SITE_PATH."vendors/Excel/");