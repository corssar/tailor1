<?php
//require_once(FRAMEWORK_PATH.'Db.php');
require_once(FRAMEWORK_PATH.'data_objects/base/DataObject.php');
/**
 * PageObjectData getting and stored PageObject information
 *
 */
class PageObjectData extends DataObject
{
	private $poId;
	/*private $db;*/
	private $properties=null;	
	
	function __construct($poId){
		$this->poId = $poId;
		$this->db = DB::getInstance();	
	}
	
	public function getId(){
		return $this->poId;
	}		
	protected function setProperties($aProperties){
		$this->properties = $aProperties;
	}	
	
	public function getProperties(){
		return $this->properties;
	}
	
	/**
	 * Geeting Base information about PageObject. For example: vewId,  ClassName ...
	 * @return bool
	 */
	public function loadBase()
	{
		$query = "
            SELECT 
                fe_Pages.langId, 
                fe_Pages.viewId, 
                be_View.className, 
                fe_Pages.title 
			FROM 
			    fe_Pages 
			        INNER JOIN 
			    be_View 
			        ON fe_Pages.viewId = be_View.viewId
			WHERE 
			    fe_Pages.id = {$this->getId()}";
		return $this->runQuery($query);
	}
	/**
	 * Geeting all information about PageObject. For example: vewId,  ClassName ...
	 * @return bool
	 */
	public function load(){
		return $this->load_new();
	}
	
	public function getValue($valueName)
	{
		if(isset($this->properties[$valueName]))
		{
			return $this->properties[$valueName];
		} 
		else 
		{
			return false;
		}
	}
	
	public function load_new(){      
        return $this->runQuery($this->getQuery()); 
	}		
	/**
	 * «апрос, который будет выполн€тьс€ при вызове метода load()
	 * ƒанный метод нужно переопредел€ть каждый раз, как вы хотите изменить запрос, выполн€емый 
	 * при вызове метода load() в классе-наследнике
	 * @return string
	 */
	protected function getQuery(){
        $query="
            SELECT 
                fe_Pages.*,  
                be_View.className
			FROM 
                fe_Pages 
			        INNER JOIN 
			    be_View 
			        ON fe_Pages.viewId = be_View.viewId
			WHERE 
			    fe_Pages.id = {$this->getId()}";
	    return $query;  
	}	
	/**
	 * ¬ыполн€ет запрос $query
	 * ¬озвращает true, если при выполнении не было ошибок
	 *
	 * @param string $query
	 * @return boolean
	 */
	protected function runQuery($query) 
	{
        if (!isset($query)) 
            throw new CMSException('Query in PageObjectData class is not set');
	    
		if ($this->db->query($query)){
			$this->setProperties($this->db->result[0]);
			return true;
		} 
		else 
		{
			if ($this->db->error !==3) 
			{// «апрос ничего не вернул
				return false;
			} 
			else 
			{// возникла ошибка при выполнении sql-запроса
				throw new CMsException(__CLASS__.'.'.__FUNCTION__.'(...). Error in query');
			}			
		}		    
	}
}
?>