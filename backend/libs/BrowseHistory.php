<?

class BrowseHistory {
	
	function  __construct()
	{
		
	}
	
	
	public function getBackJsRequest() 
	{
		
		$prevRequest = $this->getPreviousRequest();
		
		$jsArray = '{';
		foreach ( $$prevRequest['aParams'] as $key=>$value ) {
			$jsArray .= $key.":'".$value."';";
		}
		$jsArray = substr($jsArray,0,(strlen($jsArray)-1));
		
		$jsArray .= '}';

		
		return "xajax_processRequest('".$prevRequest['ajaxController']."','".$prevRequest['action']."','".$jsArray."','".$prevRequest['resultContainerId']."','".$prevRequest['loadingIndicatorContainerId']."')";
		
	}
	
	
	public function saveCurrentRequest ( $ajaxController, $action, $aParams, $resultContainerId, $loadingIndicatorContainerId, $addArray )
	{
		
		$_SESSION['history'] = array(	'ajaxController' => $ajaxController,
										'action'         => $action,
										'aParams'        => $aParams,
										'resultContainerId' => $resultContainerId,
										'loadingIndicatorContainerId' => $loadingIndicatorContainerId,
										'addArray'       => $addArray );
	}
	
	public function getPreviousRequest()
	{
		return isset($_SESSION['history'])?$_SESSION['history']:array();
	}
}


?>