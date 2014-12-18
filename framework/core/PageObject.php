<?
abstract class PageObject
{// properties
	public $poId;	
	protected $template = null;	
	protected $HTML='';
	protected $pageObjectData = array();
	
	protected $fullyCached=false;
	protected $fullyCachedTime=false;
	protected $cacheKey = null;
	protected $poCacheObj;
    public $CSS = array();
    public $JS = array();

	/** Error, returned by initPageObject */
	protected $error = false;	
	/**
	 * constructor
	 *
	 * @param integer $poId Page object ID
	 */
	function __construct($poId){
		$this->poId = $poId;
		$this->initPageObject();
		$this->setFullCache();
	}	
	//methods for propeties
	protected function setTemplate($templateFileName){
		$this->template = FRONTEND_PATH.'webcontent/'.$templateFileName;
	}
	protected function getPageObjectData(){
		return $this->pageObjectData;
	}
	protected function setPageObjectData($poData){
	    $this->pageObjectData = $poData;
	}	
	protected function setFullCache()
    {
    	//for using full cache
    	//there should be set variable: $this->fullyCached = true;
    	//in case Page have full cache, is also can be defind by busines logic
    	//if time per cache should be not general, please set time as next code: $this->pageCacheTime = SomeTime;    	
    }
    
	public function run() 
	{	
		if(!$this->cacheExist())
		{
			if($this->loadPageObject())	
			{
			    $view = new smartyView();			
				$this->HTML = $view->fetch($this->template, $this->getPageObjectData());

				$this->setCache();
				return true;
			}
			else
			{	$this->error = true;	
				return false;
			}
		}
		else 
			return true;
	}
	public function initPageObject()
	{	
		return true;		
	}
	public function loadPageObject()
	{	//Return true/false
	/*	
		This method should be rewrited for realization of PO
	*/
		//$template = 'filename';		
		//$this->setTemplate($template);		
		//$this->$pageObjectData = array();
		return true;		
	}
	
	public function getHTML() 
	{//method return HTML result of current Object work
		return  $this->HTML;
	}
	public function isError()
	{//return TRUE if error has occured
		return $this->error;
	}
	
	/* Working with PO cache */
	protected function cacheExist()
	{
		if($this->fullyCached==false)
			return false;
			
		$this->poCacheObj = new CacheFace();
		if($this->fullyCachedTime!=false){
			$this->poCacheObj->setCacheTime($this->fullyCachedTime);
		}
		if(!($data = $this->poCacheObj->get(!is_null($this->cacheKey)?$this->cacheKey:'PO_fullcache_'.$this->poId)))
			return false;

		$this->HTML = $data;
		return true;	
	}
	protected function setCache(){
		if($this->fullyCached!=false)
		{
			$this->poCacheObj->save($this->HTML);
		}
	}
	
}
?>