<?
require_once('config.php');
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/Languages.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");

//initialize default page
$params = Context::SiteSettings()->getDefaultPageParams();
if(isset($params['pagecode']))
    Context::PageCode($params['pagecode']);
elseIf(isset($params['id']))
    Context::PageId((int)$params['id']);

require_once(FRONTEND_PATH."pages/".$params['pageclass']);
exit();