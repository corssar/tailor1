<?php
include(FRAMEWORK_PATH.'system/Db.php');
include(BACKEND_PATH.'libs/Admin.php');
include(BACKEND_PATH.'libs/Session.php');
include(BACKEND_PATH.'libs/BrowseHistory.php');
include(BACKEND_PATH.'libs/FormBuilder/View.php');
include(BACKEND_PATH.'libs/FormBuilder/Fields.php');
include(BACKEND_PATH.'libs/FormBuilder/PageBuilder.php');
include(BACKEND_PATH.'libs/FormBuilder/Search.php');
include(BACKEND_PATH.'libs/FormBuilder/Tree.php');
include(BACKEND_PATH.'libs/FormBuilder/Validation.php');
include(BACKEND_PATH.'libs/FormBuilder/LanguageContent.php');

require_once(FRAMEWORK_PATH."system/appUrl.php");
require_once(FRAMEWORK_PATH."system/Languages.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/Request.php");
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
require_once(FRAMEWORK_PATH."system/CMSException.php");


include(BACKEND_PATH.'vendors/XAJAX.php');
include(BACKEND_PATH.'vendors/FCKEDITOR.php');

$db         = DB::getInstance();
$session 	= new SESSION();
$admin		= new ADMIN($session);
$xajax		= new xajax();

//$db->query("SELECT * FROM `be_Languages` ORDER BY `priority` ASC limit 1");
$db->query("SELECT * FROM `be_Languages` WHERE `id`=1");
$db->query("SELECT `key`,`value` FROM `be_AdminLanguage` WHERE `langid`={$db->result[0]['id']}");

$lang = array();
foreach ($db->result as $item)
{
	$lang[$item['key']] = $item['value'];
}

require(BACKEND_PATH.'libs/AjaxRequestController.php');

?>