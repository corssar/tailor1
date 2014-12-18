<?php

require_once('BrowseHistory.php');

$xajax->registerFunction('processRequest');
$xajax->registerFunction('goBack');
$xajax->registerFunction('cancelCatalogChanges');

$xajax->processRequest();
$xajax_js = $xajax->getJavascript('webcontent/js/','xajax.js');

function processRequest($ajaxController,$action,$aParams,$resultContainerId,$loadingIndicatorContainerId,$formDataArray = array())
{
	if($resultContainerId == "undefined")
	{
		$resultContainerId = "main_content_container";
	}
	if($loadingIndicatorContainerId == "undefined")
	{
		$loadingIndicatorContainerId = "main_content_container";
	}
	
	if (!isset($ajaxController)) {
		die('You must set $ajaxController parameter in function processRequest(...)');
	}
	
	if (!isset($action)) {
		die('You must set $action parameter in function processRequest(...)');
	}
	
	if(isset($aParams['searchType']) && $aParams['searchType']=='general')
	{
		$browseHistory = new BrowseHistory();
		$browseHistory->saveCurrentRequest($ajaxController,$action,$aParams,$resultContainerId,$loadingIndicatorContainerId,$formDataArray);
	}

	global $session, $admin;
	
	$db = DB::getInstance();

	$objResponse = new xajaxResponse();
	
	if (!$admin->auth_ok)
	{
		$objResponse->addScript('document.location="Access.php";');
		return $objResponse;
	}
	
	$response	= array();
	
	include(BACKEND_PATH."ajaxcontrollers/".$ajaxController.'.php');
	$Controller = new $ajaxController();
	$response = $Controller->$action($aParams,$formDataArray);
	
	if($response['HTML'] != '')
	{
		$objResponse->addAssign($resultContainerId, 'innerHTML', $response['HTML']);
	}
		
	if ($response['JS'] != '')
	{
		$objResponse->addScript($response['JS']);
	}
	return $objResponse;
}


function goBack($tempMenuId = 0,$tempMenuNodes = '')
{
	$browseHistory = new BrowseHistory();
	
	$objResponse = new xajaxResponse();
	$response	= array();

	global $session, $admin;
	
	$db = DB::getInstance();
	$response = array();
	
	/*
	we do not have table name to delete temp items
	if ($tempMenuId)
	{
		$objTree = new TREE($db,$tempMenuId);
		$objTree->cancelTreeChanges($tempMenuNodes);
	}*/
	
	$prevRequestArray = $browseHistory->getPreviousRequest();
	
	if (!isset($prevRequestArray['ajaxController']) || $prevRequestArray['ajaxController']=='')
	{
		$objResponse->addScript("window.location.reload();");
		return $objResponse;
	}
	
	$ajaxController    = $prevRequestArray['ajaxController'];
	$action            = $prevRequestArray['action'];
	$aParams           = $prevRequestArray['aParams'];
	$resultContainerId = $prevRequestArray['resultContainerId'];
	$loadingIndicatorContainerId = $prevRequestArray['loadingIndicatorContainerId'];
	$addArray          = $prevRequestArray['addArray'];
	
	include(BACKEND_PATH."ajaxcontrollers/".$ajaxController.'.php');
	$Controller = new $ajaxController();
	$response = $Controller->$action($aParams,$addArray);
	
	if($response['HTML'] != '')
	{
		$objResponse->addAssign($resultContainerId, 'innerHTML', $response['HTML']);
	}
		
	if ($response['JS'] != '')
	{
		$objResponse->addScript($response['JS']);
	}
	
	return $objResponse;
}

function cancelCatalogChanges($tempMenuId = 0,$tempMenuNodes = '')
{
	$objResponse = new xajaxResponse();
	$response	= array();

	global $session, $admin;
	
	$db = DB::getInstance();
	$response = array();
	
	TREE::deleteTempItems($db,"fe_ProductCategories");
	
	$objResponse->addScript("viewDataObject30 = new ViewDataObject(7,'general'); navigation.sendRequest('ViewController','viewBuild',{viewId:30,itemId:26});");
	
	return $objResponse;
}

?>