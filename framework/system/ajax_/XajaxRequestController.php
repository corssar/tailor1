<?php
//require_once '../../config/config.php';

class XajaxRequestController {
    
    private static $xajaxInstance = null;
    
    private static $instance = null;
    
	function getInstance() 
	{
		
		if (!isset(self::$instance)) 
		{
			self::$instance = new XajaxRequestController();
			
		}
		return self::$instance;
	}
	
    public static function doRequest($controllerClass, $action, $resultContainerId, $aParams, $aFormData = array(),  $loadIndicatorContainerId = null ) 
    {
    	if($resultContainerId == "undefined")
    	{
    		//$resultContainerId = "main_content_container";
    	}
    	if(!is_array($resultContainerId))
    	{
    		//throw new Exception('Nema');
    	}
    	if($loadingIndicatorContainerId == "undefined")
    	{
    		//$loadingIndicatorContainerId = "main_content_container";
    	}
    	
    	if (!isset($controllerClass)) {
    		die('You must set $controllerClass parameter in function processRequest(...)');
    	}
    	if (!isset($action)) {
    		die('You must set $action parameter in function processRequest(...)');
    	}

        $objResponse = new xajaxResponse();
    	$response	= array();
    	include(FRONTEND_PATH."handlers/".$controllerClass.'.php');
    	
        try {
            $controller = new $controllerClass();
    	    $response = $controller->$action($aParams,$aFormData);
        } catch (Exception $e) {
            self::closeDBConnections();
            $objResponse->alert($e->getMessage());
            return $objResponse;
        }
        
        if(is_array($response['HTML']))
        {
        	foreach ($response['HTML'] as $key=>$value)
        	{
        		$objResponse->assign($key, 'innerHTML', $value);
        	}
        }
    	elseif($response['HTML'] != '')
    	{
    		$objResponse->assign($resultContainerId, 'innerHTML', $response['HTML']);
    	}
    	if ($response['JS'] != '')
    	{
    		$objResponse->script($response['JS']);
    	}
    	self::closeDBConnections();
        return $objResponse;
    }
    
    function getXajaxInstance()
    {
		if (!isset(self::$xajaxInstance))
		{
			self::$xajaxInstance = new xajax();
		}
		return self::$xajaxInstance;
    }

    private static function closeDBConnections() 
    {
        // Закрываем соединения с БД
        $ukrbasketDb = DB::getInstance('ukrbasket');
        $superleagueDb = DB::getInstance();
        
        if ($ukrbasketDb->connected) {
            $ukrbasketDb->close();
        }
        
        if ($superleagueDb->connected) {
            $superleagueDb->close();
        }
    }
}
?>