<?
require_once FRAMEWORK_PATH.'data_objects/base/DataObject.php';

/**
 * ����� ������ ������� ������ MasterPage
 * 
 * ������������� � ���� ������ � �� ��� ������� �������
 * @author Govorukha Konstantin
 * @version 1.1.0
 *
 */
class MasterPageData extends DataObject  {
	/**
	 * ��������� ������ ��������������� ���������������� ��� ��������������
	 * ������:
	 * $this->aAreasPageObjects['AreaNumber'][]
	 * ������ ������ �������� ����� ���������������������
	 * ������ ���� -- ����������� �� ���������.
	 *
	 * @var array
	 */
	private $aAreasPageObjects = array();
	
	/**
	 * ������ ������� ������������ ��������(Area) �������������� 
	 *
	 * @var array
	 */
	private $aAreas = array();
	
	/**
	 * �����������
	 *
	 * @param integer $masterPageId ������������� ��������������
	 */
	function __construct($masterPageId) {
		parent::__construct($masterPageId,"fe_MasterPages");
	}
	
	/**
	 * ��������� �� �� ��� ������ ��� �������������� � ��������������� 
	 * ������ $masterPageId, ���������� � �����������
	 * 
	 * @return void
	 *
	 */
	public function load() {
		parent::load();
		
		$this->loadArea_sPageObjectsId();
	}
	/**
	 * ��������� �������������� ���������������� �� ��
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
	 * ���������� true, ���� ������� � ������� $areaNumber ����������
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
	 * ���������� ������, ���������� �������� �������� �������������� 
	 * ���������������� ��� �������, ����� ������� �����  $areaNumber
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
	 * ������������� �������� $this->AreasPageObjects
	 *
	 * @param array $aQueryAreasPageObjects ��������� ������� ���� ��������������� ����������������
	 * ��������� ������� ���������� ����� Db
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
	 * ���������� ������, ���������� �������� �������� �������������� ������������ �������� 
	 * ��� ��������������
	 *
	 * @return array
	 */
	private function getAreas() {
		return $this->aAreas;
	}	
	/**
	 * ���������� ��������� ������ -- ��� �������������� ���������������� ��� ���� 
	 * ������������ �������� ��������������
	 *
	 * @return array
	 */
	private function getAreasPageObjects() {
		return $this->aAreasPageObjects;
	}
}