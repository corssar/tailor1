<?php
/**
 * ����������� ����� "������������".
 * 
 * ������������� � ���� ������ � ��.
 * ��� ������ "��������" 
 * (�� ������������� ��� ���������!!!), 
 * ������� �������� � �� ���������� ����������� ������ �����
 * 
 * @abstract 
 * @author Govorukha Konstantin
 * 
 */
abstract class DataObject 
{	
	private $id = null;
	/**
	 * ��� ��������, ��� "��������" ������
	 */
	private $pageCode;	
	/**
	 * ��� �������, � ������� "�����" ���� ��������
	 * @var string $tableName
	 */
	public $tableName;
	/**
	 * ������ ������, ���������� ��� �������� ��������
	 * @var array ������������� ������. ���� -- ��� ��� ���� � ������� $tableName
	 */
	private $aProperties = array();	
	
	/**
	 * �����������
	 *
	 * @param integer $id
	 * @param string $tableName
	 * @param string $pageCode
	 */
	function __construct($id = null, $tableName = null, $pageCode = null) {
		if (!is_null($tableName) ) {
    		if (!is_integer($id) && !is_string($pageCode)) {
    			throw new CMSException('DataObject.__construct(...).id not numeric and pageCode not string');
    		}		
			if (!is_string($tableName) ) {
				throw new CMSException('DataObject.__construct(...). table name not string');
			}
		}
		$this->id = $id;
		$this->pageCode = $pageCode;
		$this->tableName = $tableName;
	}
	
	public function getId() {
		return (int)$this->id;
	}	
	public function setId($id) {
		$this->id = $id;
	}	
	public function getPageCode() {
		return (string)$this->pageCode;
	}

	protected function setProperties($aProperties) {
		$this->aProperties = $aProperties;
	}	
	public function getProperties() {
		return $this->aProperties;
	}
	
	/**
	 * ���������� ��� �������, � ������� "�����" ��������
	 * @return string/null
	 */
	private function getTableName() {
		return $this->tableName;
	}
	
	/**
	 * ���������� �������� ��������.
	 * @param string $dbFieldName ��� ���� � ������� $this->tableName, � ������� ����� ����������� �������� ��������
	 * @return mixed/null ������������ ��� ������� �� ���� ���� � ������� $this->tableName. 
	 * ���� ���������� ���� �� ���������� ��� ��� �� ���������, �� ���������� null
	 */
	public function getValue($dbFieldName) {		
		$properties = &$this->getProperties();
		if (isset($properties[$dbFieldName]) ) {
			return $properties[$dbFieldName];
		} else {
			return null;
		}
	}

	/**
	 * ��������� �� �� � ������ $this->aProperties ��� �������� ��������
	 * @return boolean ���������� true � ������ �������� ����������
	 */
	public function load() {
        return $this->runQuery($this->getQuery());
	}
	
	/**
	 * ������, ������� ����� ����������� ��� ������ ������ load()
	 * ������ ����� ����� �������������� ������ ���, ��� �� ������ �������� ������, ����������� 
	 * ��� ������ ������ load() � ������-����������
	 * @return string
	 */
	protected function getQuery() {    
	    if(!$this->getTableName())
	        throw new CMSException('TableName not defined');
	        
	    if(!$this->getId())
	        throw new CMSException('Id not defined');

	    return  "SELECT * FROM ".$this->getTableName()." WHERE ". $this->getPrimaryKeyForQuery();
	}
	
	/**
	 * Used for detecting which parameter used for page: id or pageCode
	 * @return string
	 */
	protected function getPrimaryKeyForQuery($primaryTableName = '')
	{
        if($primaryTableName!='')
            $primaryTableName.='.';

		if(!$this->getId() && !$this->getPageCode())
        {
			throw new CMSException('Id and pageCode for DataClass are not defined');
        }

	    if($this->getPageCode())
            $result = " {$primaryTableName}codeName = '".$this->getPageCode()."'";
        else
            $result = " {$primaryTableName}id = ".$this->getId();

	    if(Context::SiteSettings()->multiLanguage())
	    	$result .= ' and langId='.Context::LanguageId();
        if(MULTI_SITE)
            $result .= ' and ('.$primaryTableName.'websiteId='.BASE_WEBSITE_ID.' or '.$primaryTableName.'websiteId='.Context::SiteSettings()->getSiteId().')';

	    return $result;
	}
	
	/**
	 * ��������� ������ $query
	 * ���������� true, ���� ��� ���������� �� ���� ������
	 *
	 * @param string $query
	 * @return boolean
	 */
	protected function runQuery($query) {
        if (!isset($query))
            throw new CMSException('Query in DataClass is not set');

		if (Context::DB()->query($query)) {
			$this->setId(Context::DB()->result[0]['id']);
			$this->setProperties(Context::DB()->result[0]);
			return true;
		} else {				   
			if (Context::DB()->error !==3) {
                // ������ ������ �� ������
				return false;
			} else {
			    // �������� ������ ��� ���������� sql-�������
				throw new CMSException('Error in query');
			}			
		}
	}
	
	/**
	 * ��������� ������ $query.
	 * ���������� ������ ������, ������� ������ ������
	 *
	 * @param string $query
	 * @return array
	 */
	protected function runListQuery($query) {
        if (!isset($query)) {
            throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Query is not set');
        }
	    
		if (Context::DB()->query($query)) {
			return Context::DB()->result;
		} else {
			if (Context::DB()->error !==3) {
                // ������ ������ �� ������
                return array();
			} else {
			    // �������� ������ ��� ���������� sql-�������
				throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Error in query');
			}			
		}		    
	}
}

?>