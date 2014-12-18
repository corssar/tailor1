<?  
require_once(FRAMEWORK_PATH."core/base/MasterPageInterface.php");
require_once(FRAMEWORK_PATH."data_objects/base/MasterPageData.php");
require_once(FRAMEWORK_PATH."core/PageObjectBase.php");
/**
 * MasterPage. ������ ��������� ��������
 * 
 * ������ ����� ������ ��������� HTML-��������.
 * ������ �������� ������� �� ���������� ���������� ���������: MasterPage,Page,PageObjects.
 * MasterPage -- ��� �� ����� ��������, ������� ����������� � ������ �������. ��� ������� 
 * ��� ����, ����� �� ������������ ������ ��� ������ ��������, ���� �� ����� �� ������� ��� 
 * ����� �������� �����-���� ������.
 * ��� ������ �������� ������ ���� ������ �������������� -- MasterPage. �� ������� ������
 * �������� ������ MasterPage � ���������� ������ ��������, ������� ���� ���������� MasterPage --
 * ��������������
 * ��� ������ �������� ����� ������ �������������� �� 3-� �������: 
 *   1) �� ������ ����� ����������
 *   2) �� ������ ���� �������� (View)
 *   3) �� ������ ����� ��������
 * 
 * ������ �������������� ����� �������� �� ���������� "��������".
 * ������ "�������" ����� ��������� ������������ ���-�� "����������������" (PageObject)
 * ���� �������������� ����� ���������� � ���������� ��������.
 * 
 * @author Govorukha Konstantin
 * @version 1.0
 * @internal ���� ���������� ���������: 20.08.2008
 *
 */
class MasterPage extends MasterPageInterface
{
	private $cacheKey;
	/**
	 * @var array ������ "��������" �������������� (�� ������� ��������� ��������������)
	 */
	private $aAreasPageObjects = array();	
	/**
	 * @var string 	��� �������, ���. ����� ����������� ��� ����������� ������ MasterPage
	 */
	private $template = null;	
	/**
	 * @var integer �����. ��������������, ��������� � ��������� ��������, ��� ���. �� ������ MasterPage
	 */
	private $pageMasterPageId;

    public $pageObjectsCSS = array();
    public $pageObjectsJS = array();

	/**
	 * �����������
	 *   
	 * @param integer $pageMasterPageId �����. ��������������, ��������� � ��������� ��������, ��� ���. �� ������ MasterPage
	 */
	function __construct($pageMasterPageId) {
	    // Standartnij template po umolchaniju	    
	    $this->setTemplate(FRONTEND_TEMPL_PATH.'MasterPages/MasterPageTemplate.tpl');
	    
	    $this->PageMasterPageId($pageMasterPageId);
		$this->cacheKey = $this->getActiveMasterPageId();
		$this->init();
	}	
	/**
	 * �������������/���������� �����.��������������,��������� � ��������
	 *
	 * @param integer $pageMasterPageId
	 */
	public function PageMasterPageId($pageMasterPageId=null) 
	{
		if($pageMasterPageId===null)
			return $this->pageMasterPageId;

		if (!is_integer($pageMasterPageId))
			throw new CMSException('MasterPage.PageMasterPageId(). $pageMasterPageId is not int: '.$pageMasterPageId);

        $cache = new CacheFace();
        if($data = $cache->get('MP_before_'.$pageMasterPageId))
            $this->pageMasterPageId = $data;
        else {
            $query="SELECT curmp.id FROM fe_MasterPages mp
                        inner join fe_MasterPages curmp on curmp.relationId = mp.relationId and curmp.langId = mp.langId and curmp.websiteId = ".Context::SiteSettings()->getSiteId()."
                    WHERE mp.id=$pageMasterPageId";
            if(Context::DB()->query($query))
                $this->pageMasterPageId = (int)Context::DB()->result[0]['id'];
            else
                $this->pageMasterPageId = $pageMasterPageId;

            $cache->save($this->pageMasterPageId);
        }

		return $this->pageMasterPageId;
	}
	public function getActiveMasterPageId()
	{		
		return $this->PageMasterPageId() ? $this->PageMasterPageId() : Context::AppMasterPageId();
	}
	/**
	 * ���������� ��� ������� ��� ��������������
	 * @return string
	 */
	private function getTemplate() {
		if (is_null($this->template) )
		    throw new CMSException('MasterPage template is not defined');		
		return $this->template;
	}	
	protected function setTemplate($template) {
		if (!file_exists($template))
		    throw new CMSException('MasterPage template file not found. File path: '.$template);
		    
	    $this->template = $template;
	}	
	/**
	 * ������� ������� ������ PageObject ��� ���� �������� ��������������
	 *
	 * <p>������� �������� � $this->aAreas</p>
	 */
	private function createAreasPageObjects() {
		$areasCount = APPLICATION_MASTER_PAGE_AREAS_COUNT;
		// ������: $aAreaPageObjectsId['1']  �������� ������ ID ���������������� ��� �������1
		$aAreaPageObjectsID = array();
		
		$cache = new CacheFace();
        if($data = $cache->get('MP_areasObjIDs_'.$this->cacheKey)){
   			$aAreaPageObjectsID = unserialize($data);
		}
		else {				
			$aAreaPageObjectsID	= $this->getPageObjectsArray($this->loadMasterPageData($this->getActiveMasterPageId()), $areasCount);			
			$cache->save(serialize($aAreaPageObjectsID));
		}	
			
		for ($areaIterator = 1;$areaIterator <= $areasCount; $areaIterator++) 
		{
			$aAreaPageObjects = array();			
			foreach ($aAreaPageObjectsID[$areaIterator] as $curAreaPageObjectId)
			{
				$pageObject = $this->createPageObject($curAreaPageObjectId);

				if (is_object($pageObject)) {
    				array_push($aAreaPageObjects, $pageObject);
                    $this->pageObjectsCSS = array_merge($this->pageObjectsCSS, $pageObject->PoObj->CSS);
                    $this->pageObjectsJS = array_merge($this->pageObjectsJS, array_diff($pageObject->PoObj->JS, $this->pageObjectsJS));
				} else {				    
				    throw new CMSException("PageObject $curAreaPageObjectId in area $areaIterator not found in database. PageObject not a object.");
				}				
			}
			$this->setAreaPageObjects($areaIterator,$aAreaPageObjects);
			
			unset($aAreaPageObjects);
		}
	}
	
	private function getPageObjectsArray($appMasterPageData, $areasCount)
	{
		for ($areaIterator = 1;$areaIterator <= $areasCount; $areaIterator++) 
		{
		    $appMasterPagePageObjectsIds = $appMasterPageData->getPageObjectsIds($areaIterator);
			if (!is_null($appMasterPagePageObjectsIds))
			    $aAreaPageObjectsID[$areaIterator] = $appMasterPagePageObjectsIds;
			else
			    $aAreaPageObjectsID[$areaIterator] = array();
		}
		return $aAreaPageObjectsID;
	}
	
	
	/**
	 * ������������� ��� ��������� ������� ������ �������� ������ PageObject
	 *
	 * @param integer $areaNumber ����� ������� ��������������
	 * @param array $aAreaPageObjects ������ �������� ������ PageObject ��� ��������� �������
	 */
	private function setAreaPageObjects($areaNumber,$aAreaPageObjects) {
		$this->aAreasPageObjects[$areaNumber] = $aAreaPageObjects;
	}
	
	/**
	 * ���������� ������ ������� PageObject ��� ��������� �������
	 *
	 * @param integer $areaNumber
	 * @return array
	 */
	private function getAreaPageObjects($areaNumber) {
		return $this->aAreasPageObjects[$areaNumber];
	}
	/**
	 * ���������� ������ ������ MasterPageData
	 *
	 * @param string $mPOType
	 * @return MasterPageData
	 */
	private function loadMasterPageData($masterPageid) 
	{
		$masterPageData = new MasterPageData($masterPageid);
		$masterPageData->load();
		return $masterPageData;
	}
	
	/**
	 * ������� ������ ������-���������� PageObject
	 *
	 * �������������� ����� ��������� n-��� ���-�� ����������������, ������� ������� �� ��������� ��������.
	 * ���������� � ���, ����� ��������������� �������� ������� �������������� ��������� � ��.
	 * ��� �������� ������� ������-���������� PageObject ���������� ����� �������� ������-���������� ������ PageObject.
	 * ������ �������� �������� � ��. ������ � ���� ����� �������� ����� ������ DBO_PageObject (�������� ����� load($id) )
	 * 
	 * @param integer $pageObjectId �����. ������� DBO_PageObject �� �������� ����� ������ 
	 * ������ ������-���������� PageObject
	 * @return PageObject/null ���������� null, ���� ��� �������� ��������������� �������� ������
	 */
	private function createPageObject($pageObjectId) {
		$pageObject = new PageObjectBase($pageObjectId);
		
		if (!$pageObject->isError()) {
		    return $pageObject;
		} else {
		    return null;
		}
	}	
	/**
	 * �������������� ��� PageObject-� ��� ������� MasterPage
	 * ���������� �� ������������
	 */
	private function init() {
		$this->createAreasPageObjects();		
	}	
	/**
	 * ���������� ��������� ������ ���������� HTML (������������ ������ ����������������) 
     * ��� ���� ���������������� (���� �������� ��������������), ������� ���������� 
     * ���������� � ��������������.
	 *
	 * @return array
	 */
	public function load() {		
		/** @var array $aAreasHtml ��������� ������, ���������� HTML (������������ ������ ����������������) 
		 * ��� ���� �������� �������������� 
		 */
		$aAreasHtml = array();
		
		$areasCount = APPLICATION_MASTER_PAGE_AREAS_COUNT;
				
		for($areaIterator = 1;$areaIterator <= $areasCount; $areaIterator++) {
			$aAreasHtml[$areaIterator] = array();
			$aAreaPageObjects = $this->getAreaPageObjects($areaIterator);
			foreach ($aAreaPageObjects as $curAreaPageObject) {
				if (! $curAreaPageObject->run() ) {
					throw new CMSException('Function Run of pageobject has returned false.PageObject id:'.$curAreaPageObject->poId);
				}
				$htmlPageObject = $curAreaPageObject->getHTML();
				array_push($aAreasHtml[$areaIterator], $htmlPageObject);		
			}
		}	
		return $aAreasHtml;
	}
	
	
	/**
	 * ������������ � ������� �� ����� �������������� � �������� (������ ��������������)
	 *
	 * @param string $pageHTMl
	 * @param string $pageHeaderHTML
	 */
	public function run($pageHTMl, $pageHeaderHTML, $pageHeaderMETA, $pageHeaderJS, $pageHeaderCSS) {
		$view = new SmartyView();
        
		$data['aAreasHTML'] = $this->load();
		$data['pageHTML'] = $pageHTMl;
		$data['pageHeaderHTML'] = $pageHeaderHTML;
        $data['pageHeaderMETA'] = $pageHeaderMETA;		
		$data['pageHeaderJS'] = $pageHeaderJS;
		$data['pageHeaderCSS'] = $pageHeaderCSS;

		$Languages = Languages::getInstance();
		$data['metaLanguageTag'] = $Languages->GetMetaTagByCode(Context::LanguageCode());
        
		$aAreasNames = array();	
		$areaNamePrefix = 'area';
		for($areaIterator=1;$areaIterator<=APPLICATION_MASTER_PAGE_AREAS_COUNT; $areaIterator++) {
		   $aAreasNames[$areaIterator] = $areaNamePrefix.$areaIterator; 
		}		
		$data['aAreaNames'] = $aAreasNames;
        $data['siteUrl'] = Context::SiteSettings()->getSiteUrl();
		
		return $view->fetch($this->getTemplate(), $data);
	}

	
}



?>