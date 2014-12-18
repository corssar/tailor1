<?php
/**
 * Абстрактный класс "ОбъектДанных".
 * 
 * Инкапсулирует в себе работу с БД.
 * Для каждой "сущности" 
 * (не воспринимайте это буквально!!!), 
 * которая хранится в БД необходимо наследовать данный класс
 * 
 * @abstract 
 * @author Govorukha Konstantin
 * 
 */
abstract class DataObject 
{	
	private $id = null;
	/**
	 * Код страницы, для "красивых" ссылок
	 */
	private $pageCode;	
	/**
	 * Имя таблицы, в которой "лежит" наша сущность
	 * @var string $tableName
	 */
	public $tableName;
	/**
	 * Массив данных, содержащих все свойства сущности
	 * @var array ассоциативный массив. Ключ -- это имя поля в таблице $tableName
	 */
	private $aProperties = array();	
	
	/**
	 * Конструктор
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
	 * Возвращает имя таблицы, в которой "лежит" сущность
	 * @return string/null
	 */
	private function getTableName() {
		return $this->tableName;
	}
	
	/**
	 * Возвращает свойство сущности.
	 * @param string $dbFieldName имя поля в таблице $this->tableName, в котором лежит необходимое свойство сущности
	 * @return mixed/null Возвращаемый тип зависит от типа поля в таблице $this->tableName. 
	 * Если указанного поля не существует или оно не заполнено, то возвращает null
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
	 * Загружает из БД в массив $this->aProperties все свойства сущности
	 * @return boolean Возвращает true в случае удачного завершения
	 */
	public function load() {
        return $this->runQuery($this->getQuery());
	}
	
	/**
	 * Запрос, который будет выполняться при вызове метода load()
	 * Данный метод нужно переопределять каждый раз, как вы хотите изменить запрос, выполняемый 
	 * при вызове метода load() в классе-наследнике
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
	 * Выполняет запрос $query
	 * Возвращает true, если при выполнении не было ошибок
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
                // Запрос ничего не вернул
				return false;
			} else {
			    // возникла ошибка при выполнении sql-запроса
				throw new CMSException('Error in query');
			}			
		}
	}
	
	/**
	 * Выполняет запрос $query.
	 * Возвращает массив данных, который вернул запрос
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
                // Запрос ничего не вернул
                return array();
			} else {
			    // возникла ошибка при выполнении sql-запроса
				throw new Exception(__CLASS__.'.'.__FUNCTION__.'(...). Error in query');
			}			
		}		    
	}
}

?>