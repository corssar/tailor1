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
	 * ������, ������� ����� ����������� ��� ������ ������ load()
	 * ������ ����� ����� �������������� ������ ���, ��� �� ������ �������� ������, ����������� 
	 * ��� ������ ������ load() � ������-����������
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
	 * ��������� ������ $query
	 * ���������� true, ���� ��� ���������� �� ���� ������
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
			{// ������ ������ �� ������
				return false;
			} 
			else 
			{// �������� ������ ��� ���������� sql-�������
				throw new CMsException(__CLASS__.'.'.__FUNCTION__.'(...). Error in query');
			}			
		}		    
	}
}
?>