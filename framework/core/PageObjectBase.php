<?php
require_once(FRAMEWORK_PATH."/data_objects/base/PageObjectData.php");
class PageObjectBase
{
	public $poId;
	protected $poViewId;
	protected $poClassName;
    public $poObj;
	protected $HTML;
	protected $error=false;	 
	
	/**
	 * @param integer $poId Идент. PageObject из БД
	 */
	function __construct($poId) 
	{	
		$this->poId = $poId;
		$this->initializeRealPO();
	}
	
	public function isError()
	{//return TRUE if error has occured
		return $this->error;
	}	
	/**
	 * создает и инициализирует объект наследник класса PageObject
	 *
	 */
	protected function initializeRealPO()
	{//determine PO class name by id
		if($this->getPoClassName())
		{		
			$this->PoClassName = $this->getPoClassName();
			include_once(SITE_PATH.'frontend/objects/'.$this->PoClassName);
			$className = str_replace('.php','',$this->PoClassName);
			$this->PoObj = new $className($this->poId);
			//checking error in initialized object
			$this->error = $this->PoObj->isError();
		}
		else 
		{
			$this->error = true;
		}		
	}
	
	protected function getPoClassName()
	{
		if(!isset($this->PoObj))
		{
			$cache = new CacheFace();		
	        if($data = $cache->get('POBase_'.$this->poId)){
	   			$this->PoObj = unserialize($data);
			}
			else 
			{
				$this->PoObj = new PageObjectData($this->poId);
				$this->PoObj->loadBase();
				$cache->save(serialize($this->PoObj));
			}			
		}		
		if($this->PoObj->getValue('className')){
			return $this->PoObj->getValue('className');
		}
		else{
			return false;
		}
	}
	
	public function getHTML() 
	{//method return HTML result of page Object work
		return  $this->HTML;
	}	
	/**
	 * Run base PO logic
	 *
	 * @return boolean
	 */
	protected function loadPageObject()
	{
		return $this->PoObj->run();
	}
	
	public function run()
	{
		if($this->loadPageObject()){
			$this->HTML = $this->PoObj->getHTML();
			return true;
		}
		else{		
			return false;
		}
	}
}

?>