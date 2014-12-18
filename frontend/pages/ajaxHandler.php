<?php
include("../../config.php");

require_once(FRONTEND_PATH."config.php");
require_once(FRAMEWORK_PATH."system/Db.php");
require_once(FRAMEWORK_PATH."system/Request.php");
require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");

if(Context::SiteSettings()->multiLanguage() && isset($_SERVER['HTTP_REFERER']))
{
    $urlPos = strpos($_SERVER['HTTP_REFERER'], Context::SiteSettings()->getSiteUrl());
    $url = substr($_SERVER['HTTP_REFERER'], $urlPos + strlen(Context::SiteSettings()->getSiteUrl()));
	$matches	=	explode("/",$url);
	if(isset($matches[1]) && strlen($matches[1])>0 && strlen($matches[1])<4)
		Context::SpecifyLang($matches[1]);
}

try 
{
	if(Request::validateStrSymbols(Request::getString('handler', 'REQUEST')) && strlen(Request::getString('handler', 'REQUEST'))>0)
	{
		include(FRONTEND_PATH.'handlers/'.Request::getString('handler', 'REQUEST').'.php');
	} else {
		throw new Exception('No file to include');
	}
} catch (Exception $e)
{
	echo 'Exception: ',  $e->getMessage(), "\n";
}

?>