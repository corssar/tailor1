<?
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * Класс данных объекта данных MasterPage
 * 
 * Инкапсулирует в себе работу с БД для данного объекта
 * @author Govorukha Konstantin
 * @version 1.1.0
 *
 */
class MasterPageData extends DataObject  {
	/**
	 * Двумерный массив идентификаторов ОбъектовСтраницы для МастерСтраницы
	 * Пример:
	 * $this->aAreasPageObjects['AreaNumber'][]
	 * Первым ключом является номер ОбластиМастерСтраницы
	 * Второй ключ -- стандартный по умолчанию.
	 *
	 * @var array
	 */
	private $aAreasPageObjects = array();
	
	/**
	 * Массив номеров существующих Областей(Area) МастерСтраницы 
	 *
	 * @var array
	 */
	private $aAreas = array();
	
	/**
	 * Конструктор
	 *
	 * @param integer $masterPageId идентификатор МастерСтраницы
	 */
	function __construct($masterPageId) {
		parent::__construct($masterPageId,"fe_MasterPages");
	}
	
	/**
	 * Загружает из БД все данные для МастерСтраницы с идентификатором 
	 * равным $masterPageId, переданным в конструктор
	 * 
	 * @return void
	 *
	 */
	public function load() {
		parent::load();
		
		$this->loadArea_sPageObjectsId();
	}
	/**
	 * Загружает идентификаторы ОбъектовСтраницы из БД
	 *
	 * @return boolean
	 */
	private function loadArea_sPageObjectsId() {
	    $query = "
			SELECT 
			    poia.areaNumber, 
			    poia.pageObjectId as pageObjectId 
			FROM 
			    fe_PageObjectsInAreas poia
			WHERE 
			    poia.masterPageId = {$this->getId()}
			ORDER BY
			    poia.id";

		if (Context::DB()->query($query)) {
			$this->setAreasPageObjects(Context::DB()->result);
			return true;
		} else {
			if (Context::DB()->error !==3) {
				return false;
			} else {
				throw new CMSException('SQL error during select object for masterpage. loadArea_sPageObjectsId()');
				
			}
		}
	}	
	/**
	 * Возвращает true, если область с номером $areaNumber существует
	 *
	 * @param integer $areaNumber
	 * @return boolean
	 */
	public function isDefinedArea($areaNumber) {
		$aAreas = $this->getAreas();
		if ( false !== array_search($areaNumber,$aAreas) ) {
			return true;
		} else {
			return false;
		}		
	}
	
	private function addArea($areaNumber) {
	    array_push($this->aAreas,$areaNumber);
	}
	/**
	 * Возвращает массив, элементами которого являются идентификатора 
	 * ОбъектовСтраницы для Области, номер которой равен  $areaNumber
	 * 
	 * @param in $areaNumber
	 * @return array
	 */
	public function getPageObjectsIds ($areaNumber) {
		$aAreaPageObjects = $this->getAreasPageObjects();		
		if(isset($aAreaPageObjects[$areaNumber]))
			return $aAreaPageObjects[$areaNumber];
	}	
	/**
	 * Устанавливает свойство $this->AreasPageObjects
	 *
	 * @param array $aQueryAreasPageObjects результат выборки всех идентификаторов ОбъектовСтраницы
	 * Результат выборки возвращает класс Db
	 */
	private function setAreasPageObjects($aQueryAreasPageObjects) {
		$aAreasPageObjects = array();
		
		foreach ($aQueryAreasPageObjects as $queryAreasPageObjectsIterator) {
			$areaNumber = $queryAreasPageObjectsIterator['areaNumber'];
			$pageObjectId = $queryAreasPageObjectsIterator['pageObjectId'];
			
			if (!$this->isDefinedArea($areaNumber)) {
                $this->addArea($areaNumber);
			}			
			if (!isset($aAreasPageObjects[$areaNumber]) ) {
				$aAreasPageObjects[$areaNumber] = array();
			}
			if ($pageObjectId !== null) {
				array_push($aAreasPageObjects[$areaNumber],$pageObjectId);
			}
		}		
		$this->aAreasPageObjects = $aAreasPageObjects;		
	}	
	/**
	 * Возвращает массив, элементами которого являются идентификаторы существующих Областей 
	 * для МастерСтраницы
	 *
	 * @return array
	 */
	private function getAreas() {
		return $this->aAreas;
	}	
	/**
	 * Возвращает двумерный массив -- все идентификаторы ОбъектовСтраницы для всех 
	 * существующих Областей МастерСтраницы
	 *
	 * @return array
	 */
	private function getAreasPageObjects() {
		return $this->aAreasPageObjects;
	}
}