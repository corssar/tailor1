<?
class CacheController {
	
	public function deleteAllCache($parameters)
	{
		global $lang;
	    $cache = new CacheFace(true);
    	$cache->clean(false);
    
		$this->response['HTML'] = 'All cache deleted';
		$this->response['JS'] 	= 'alert("All cache deleted");';
		return $this->response;
	}
	
	public function deleteCacheGroup()
	{
		if(isset($_GET['group']))
		$group=$_GET['group'];
		else 
			$group = false;
	
    	$cache = new CacheFace();
    	$cache->clean($group);
	}
}

?>