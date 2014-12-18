<?  
require_once(FRAMEWORK_PATH."core/base/MasterPageInterface.php");
require_once(FRAMEWORK_PATH."data_objects/base/MasterPageData.php");
require_once(FRAMEWORK_PATH."core/PageObjectBase.php");
/**
 * MasterPage. Задает структуру страницы
 * 
 * Данный класс задает структуру HTML-страницы.
 * Каждая страница состоит из нескольких логических элементов: MasterPage,Page,PageObjects.
 * MasterPage -- это та часть страницы, которая повторяется в группе страниц. Она сделана 
 * для того, чтобы не переписывать каждый раз логику страницы, если на одной из страниц нам 
 * нужно добавить какой-либо объект.
 * Для каждой страницы должен быть задана МастерСтраница -- MasterPage. Не следует путать
 * названия класса MasterPage с логической частью страницы, которая тоже называется MasterPage --
 * МастерСтраница
 * Для каждой страницы можно задать МастерСтраницу на 3-х уровнях: 
 *   1) на уровне всего приложения
 *   2) на уровне типа страницы (View)
 *   3) на уровне самой страницы
 * 
 * Каждая МастерСтраница может состоять их нескольких "Областей".
 * Каждая "Область" может содержать произвольное кол-во "ОбъектовСтраницы" (PageObject)
 * Один ОбъектСтраницы может находиться в нескольких Областях.
 * 
 * @author Govorukha Konstantin
 * @version 1.0
 * @internal Дата последнего изменения: 20.08.2008
 *
 */
class MasterPage extends MasterPageInterface
{
	private $cacheKey;
	/**
	 * @var array Массив "Областей" МастерСтраницы (на которые разделена МастерСтраница)
	 */
	private $aAreasPageObjects = array();	
	/**
	 * @var string 	Имя шаблона, кот. будет использован для отображения данной MasterPage
	 */
	private $template = null;	
	/**
	 * @var integer Идент. МастерСтраницы, указанный в свойствах Страницы, для кот. мы строим MasterPage
	 */
	private $pageMasterPageId;

    public $pageObjectsCSS = array();
    public $pageObjectsJS = array();

	/**
	 * Конструктор
	 *   
	 * @param integer $pageMasterPageId Идент. МастерСтраницы, указанный в свойствах Страницы, для кот. мы строим MasterPage
	 */
	function __construct($pageMasterPageId) {
	    // Standartnij template po umolchaniju	    
	    $this->setTemplate(FRONTEND_TEMPL_PATH.'MasterPages/MasterPageTemplate.tpl');
	    
	    $this->PageMasterPageId($pageMasterPageId);
		$this->cacheKey = $this->getActiveMasterPageId();
		$this->init();
	}	
	/**
	 * Устанавливает/Возвращает идент.МастерСтраницы,указанный в Странице
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
	 * Возвращает имя шаблона для МастерСтраницы
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
	 * Создает объекты класса PageObject для всех Областей МастерСтраницы
	 *
	 * <p>Объекты хранятся в $this->aAreas</p>
	 */
	private function createAreasPageObjects() {
		$areasCount = APPLICATION_MASTER_PAGE_AREAS_COUNT;
		// Пример: $aAreaPageObjectsId['1']  содержит массив ID ОбъектовСтраницы для Области1
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
	 * Устанавливает для указанной Области список объектов класса PageObject
	 *
	 * @param integer $areaNumber Номер Области МастерСтраницы
	 * @param array $aAreaPageObjects массив объектов класса PageObject для указанной области
	 */
	private function setAreaPageObjects($areaNumber,$aAreaPageObjects) {
		$this->aAreasPageObjects[$areaNumber] = $aAreaPageObjects;
	}
	
	/**
	 * Возвращает массив классов PageObject для указанной Области
	 *
	 * @param integer $areaNumber
	 * @return array
	 */
	private function getAreaPageObjects($areaNumber) {
		return $this->aAreasPageObjects[$areaNumber];
	}
	/**
	 * Возвращает объект класса MasterPageData
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
	 * Создает объект класса-наследника PageObject
	 *
	 * МастерСтраница может содержать n-ное кол-во ОбъектовСтраницы, которые разбиты на несколько Областей.
	 * Информация о том, какие ОбъектыСтраницы содержит текущая МастерСтраница находится в БД.
	 * Для создания объекта класса-наследника PageObject необходимо знать название класса-наследника класса PageObject.
	 * Данное название хранится в БД. Доступ к нему можно получить через объект DBO_PageObject (смотрите метод load($id) )
	 * 
	 * @param integer $pageObjectId Идент. объекта DBO_PageObject по которому будет создан 
	 * объект класса-наследника PageObject
	 * @return PageObject/null Возвращает null, если при создании ОбъектаСтраницы возникла ошибка
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
	 * Инициализирует все PageObject-ы для данного MasterPage
	 * Вызывается из конструктора
	 */
	private function init() {
		$this->createAreasPageObjects();		
	}	
	/**
	 * Возвращает двумерный массив содержащий HTML (генерируемый каждым ОбъектомСтраницы) 
     * для всех ОбъектовСтраницы (всех Областей МастерСтраницы), которые необходимо 
     * отобразить в МастерСтранице.
	 *
	 * @return array
	 */
	public function load() {		
		/** @var array $aAreasHtml двумерный массив, содержащий HTML (генерируемый каждым ОбъектомСтраницы) 
		 * для всех Областей МастерСтраницы 
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
	 * Конструирует и выводит на экран МастерСтраницу и Страницу (внутри МастерСтраницы)
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