<?php
/**
 * Page. Класс Страница.
 * Базовый класс.
 *
 * Обработка всех исключений (exceptions) проводится в нем.
 *
 * @author Govorukha Konstantin, Melnichuk Maxim
 */
require_once(FRONTEND_PATH."config.php");
require_once(FRAMEWORK_PATH."core/base/PageInterface.php");
require_once(FRAMEWORK_PATH."system/Db.php");
require_once(FRAMEWORK_PATH."system/Request.php");
require_once(FRAMEWORK_PATH."system/Context.php");
require_once(FRAMEWORK_PATH."system/helper/LinkManager.php");
require_once(FRAMEWORK_PATH."system/cache/CacheFace.php");
include_once(FRAMEWORK_PATH."system/CMSException.php");

abstract class Page implements PageInterface
{	
	protected $masterPage = null;
    protected $currentFilename = null;
	protected $template = null;
    protected $basePageDataObj = null;	
	private $pageId = null;
	private $pageCode = null;
	protected $defaultPageDataClass = 'PageData';
	
	protected $pageData = null;
	protected $templateData = null;
	
	protected $fullyCached=false;	
	protected $cacheObj;
	protected $pageCacheTime=null;
	private $cacheKey=null;	
	
	protected $requireAuthorization=false;
	protected $documentHTML=null;
	
	/* debuging variables*/
	protected $pageStartTime;
    protected $registerPageViewId = 37;//75;
    protected $META = array();
    protected $JS = array();
    protected $CSS = array();

    protected $isAjax = false;

	// изменения в модели  
	protected function init() {}	
	
	function __construct() 
	{
		$this -> pageStartTime = microtime(true);
		//checking if Authorithation are required
		$this -> isRequireAuth();

		// initialize page Id
		$this -> initPageId();
		$this -> setFullCache();
		$this -> currentFilename = basename($_SERVER['SCRIPT_NAME'], ".php");

        //ajax system
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            $this->isAjax = true;
            $this->ajax();
        }

        //cache block
        if($this->fullyCached && Context::SiteSettings()->useCache())
        {
            $this->cacheObj = new CacheFace();
            if($data = $this->cacheObj->getTime('full'.$this->cacheKey(), $this->pageCacheTime))
                $this->documentHTML = $data;
        }

		if (is_null($this->documentHTML))
		{
			include_once(FRAMEWORK_PATH.'core/MasterPage.php');
			include_once(FRAMEWORK_PATH.'system/tpl_engine/SmartyView.php');
			include_once(FRAMEWORK_PATH.'system/appUrl.php');
			include_once(FRAMEWORK_PATH.'system/WebText.php');
			include_once(FRAMEWORK_PATH.'system/Context.php');
			include_once(FRAMEWORK_PATH.'data_objects/base/'.$this->defaultPageDataClass.'.php');
			include_once(FRAMEWORK_PATH."core/PageObject.php");

			try 
			{
	    		$this->loadPageData();	
	    		$pageData = $this->basePageData();
	    		$this->init();
	    		//initialize master page Structure and object
	    	    $pageMasterPageId = (integer)$pageData->getValue('masterPageId');
	    	    $this->masterPage = new MasterPage($pageMasterPageId);
			}
			catch (PageNotFoundException $e){
				$this->pageNotFound();
			}
			catch (CMSException $e) {
			    $e->terminateApplication();
			}
			catch (Exception $e) {
			    // ПЕРЕПИСАТЬ ОБРАБОТКУ ИСКЛЮЧЕНИЙ
			    echo "Exeption: ".$e->getMessage()."\n<br>".$e->getTraceAsString();
			    exit();
			}
		}
	}
	
    protected function initPageId()
    {
    	if(Context::PageId()!=null || Context::PageCode()!=null){
    		$this->pageId = Context::PageId();
	    	//needed for error pages
	    	$this->pageCode = Context::PageCode();
    	}
    	else
		{
			if(strlen($pageCode = Request::getString('pagecode','GET'))>0){
    	    	$this->pageCode = $pageCode;
    	    }
    	    elseif(($pageId = Request::getInt('id','GET')) > 0){
                if($pageId == 404 && $this->defaultPageDataClass == 'PageData')
                    $this->pageCode = '404';
                else
    	    	    $this->setPageId($pageId);
    	    }    	    
    	    else{
    	        throw new CMSException('PageId or PageCode is not defined');
    	    }
	    }
    }
    
    protected function getPageId() {
		return $this->pageId;		
	}	
	protected function getPageCode() {
		return $this->pageCode;
	}	
	protected function setPageId($pageId) {
		$this->pageId = $pageId;
		Context::PageId($pageId);
	}	
	//Initialize data class for page 
	private function loadPageData()
	{
		$cache = new CacheFace();		
        if($data = $cache->get('PageData_'.$this->cacheKey())){
   			$pageData = unserialize($data);
		}
		else
		{
	        $pageData = new $this->defaultPageDataClass($this->getPageId(), $this->getPageCode());
		    if (!$pageData->loadBase())
		    	throw new PageNotFoundException('Page not found in database. id/code  =  '.$this->getPageId().'/'.$this->getPageCode());

			$cache->save(serialize($pageData));
		} 
	    $this->setPageId($pageData->getId());
	    $this->basePageData($pageData);
	    return true;
	}
	protected function basePageData($pageData=null){
		if($pageData){
			$this->basePageDataObj = $pageData;
            Context::PageClass($this->basePageDataObj->tableName);
        }
		else 
			return $this->basePageDataObj;
	}
	protected function getTemplate() {
		return $this->template;
	}	    
	protected function getPageHeaderHTML() 
	{
		$currentTitle = strlen($this->basePageDataObj->getValue('seoTitle'))>0 ? $this->basePageDataObj->getValue('seoTitle') : $this->basePageDataObj->getValue('title');		
		//generate title + site name
		$additionalTitle = WebText::getText('WEBSITE_TITLE_PREFIX','', true);
		$pageTitle = USE_TITLE_PREFIX ? $additionalTitle.$currentTitle : $currentTitle.$additionalTitle;
			    
	    $pageHeaderHTML = "<title>{$pageTitle}</title>";
	    if(strlen($this->basePageDataObj->getValue('seo1'))>0){
	    	$pageHeaderHTML = $pageHeaderHTML."\n".'<meta name="description" content="'.$this->basePageDataObj->getValue('seo1').'"/>';
	    }
	    if(strlen($this->basePageDataObj->getValue('seo2'))>0){
	    	$pageHeaderHTML = $pageHeaderHTML."\n".'<meta name="keywords" content="'.$this->basePageDataObj->getValue('seo2').'"/>';
	    }
        if($this->basePageDataObj->getValue('noindex') == 1){
            $pageHeaderHTML = $pageHeaderHTML."\n".'<meta name="robots" content="noindex"/>';
        }
	    return $pageHeaderHTML;
	}
	
	protected function addPageHeaderMETA($meta)
    {
        $this->META[] = $meta;
    }

    protected function getPageHeaderMETA()
    {
        $pageHeaderMETA = "";
        if(count($this->META)>0)
            foreach($this->META as $meta)
                $pageHeaderMETA = $pageHeaderMETA ."\n" . $meta;

        return $pageHeaderMETA;
    }
	
    protected function getPageHeaderJS()
    {
        $pageHeaderJS = "";
        $this->JS = array_merge($this->JS, array_diff($this->masterPage->pageObjectsJS, $this->JS));
        foreach($this->JS as $js)
        {
            $pageHeaderJS = $pageHeaderJS ."\n" . "<script type='text/javascript' src='" . SITE_PROTOCOL . SiteSettings::getSiteUrl() . $js . "'></script>";
        }

        return $pageHeaderJS;
    }

    protected function getPageHeaderCSS()
    {
        $pageHeaderCSS = "";
        $this->CSS = array_merge($this->CSS, array_diff($this->masterPage->pageObjectsCSS, $this->CSS));
        foreach($this->CSS as $css)
        {
            $pageHeaderCSS = $pageHeaderCSS ."\n" . "<link rel='stylesheet' type='text/css' href='" . SITE_PROTOCOL . SiteSettings::getSiteUrl() . $css . "'>";
        }

        return $pageHeaderCSS;
    }
	
	function run() 
	{
		//if html of this page do not exist in cache
	 	if (is_null($this->documentHTML))
		{
		    try 
		    {
	            $data = $this->load();
		    	
	    	    $view = new SmartyView();
	            if (is_null($this->getTemplate()) )
	                throw new CMSException('Page template not defined!!!');
	    	    
	    	    $pageHTML = $view->fetch(FRONTEND_TEMPL_PATH.$this->getTemplate(),$data);
	    	    $pageHeaderHTML = $this->getPageHeaderHTML();
	    	    $pageHeaderMETA = $this->getPageHeaderMETA();
                $pageHeaderJS = $this->getPageHeaderJS();
                $pageHeaderCSS = $this->getPageHeaderCSS();

	    	    $this->documentHTML = $this->masterPage->run($pageHTML,$pageHeaderHTML, $pageHeaderMETA, $pageHeaderJS, $pageHeaderCSS);
		    }
		    catch (PageNotFoundException $e){
				$this->pageNotFound();
			}
		    catch (CMSException $e){
			    $e->terminateApplication();
			}
		    catch (Exception $e){
		        // Обработка исключений
	            echo "Exeption: ".$e->getMessage()."\n<br/>".$e->getTraceAsString();
		        return false;
		    }

		    if($this->fullyCached && USE_CACHE)
		       	$this->cacheObj->save($this->documentHTML);
	    }	    
	    // Закрываем соединения с БД
	    $pageConnections = $this->closeDBConnections();	    
	    if(DEBUG_MODE)
	    {
	    	include_once(SITE_PATH.'vendors/Pear/Log.php');
	    	include_once(FRAMEWORK_PATH.'system/visitorInfo.php');
			$cache = Context::SiteSettings()->useCache()?'1':'0';
			$logger = &Log::singleton('file', SITE_PATH.'logs/pages.log');			
			$logger->log(visitorInfo::getIP()."\t conn {$pageConnections[1]}\t queries {$pageConnections[0]}\t time ".round((microtime(true) - $this->pageStartTime),2)."\t {$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}\t".$cache);
	    }
	    echo $this->documentHTML;	    
	    return true;
	}
	
    protected function closeDBConnections()
    {
       // Закрываем соединения с БД
       $Db = DB::getInstance();
   
        //DB::closeAll();    
        if ($Db ->connected){
            $Db ->close();
    	}
        $array[0] = $Db ->queryCount;
        $array[1] = $Db ->connectCount;
        return $array;
    }
    
    //if page should have full cache, you need define protected function setFullCache() as in base class     
    protected function setFullCache()
    {
    	//for using full cache
    	//there should be set variable: $this->fullyCached = true;
    	//in case Page have full cache, it also can be defind by busines logic
    	//if time per cache should be not general, please set time as next code: $this->pageCacheTime = SomeTime;
    	$this->fullyCached = false;
    }
    protected function cacheKey($key=null)
    {
    	if(!is_null($key))
    	{
    		$this->cacheKey = $key;
    	}
    	else {    		
    		return (!is_null($this->cacheKey) ? $this->cacheKey : "page_{$this->currentFilename}_{$this->getPageId()}_{$this->getPageCode()}_".Context::LanguageCode());
    	}
    }
    protected function isRequireAuth()
    {
    	if($this->requireAuthorization)
		{//if page required authorized user
			require_once(FRAMEWORK_PATH."system/user/CMSUser.php");
			$user = CMSUser::getInstance();		
			if(!$user->isLogged)
			{
				if(!isset($_SESSION))
					session_start();
					
				$currentUrl = SITE_PROTOCOL.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
				$_SESSION['ipr_referer'] = $currentUrl;
				//redirect to the login page
				include_once(FRAMEWORK_PATH."system/appUrl.php");
                if($registerPageUrl = LinkManager::GetSystemPageUrl($this->registerPageViewId)){
                    header('Location: '.$registerPageUrl);
                }
                else{
                    if($registerPageUrl = LinkManager::GetSystemPageUrl($this->registerPageViewId, true))
                        header('Location: '.$registerPageUrl);
                    else
                        $this->pageNotFound();
                }
				exit;
			}
		}
    }
    protected function pageNotFound()
    {
    	header('HTTP/1.1 404 Not Found');
    	Context::PageCode('404');
		include_once(FRONTEND_PATH."pages/error.php");
		exit;
    }

    private function ajax()
    {
        try
        {
            $controllerName = Request::getString("controller");
            include_once(FRONTEND_PATH."handlers/".$controllerName.".php");
            $controller = new $controllerName();
            $controllerMethod = Request::getString("method", "REQUEST", false);

            $data = json_encode($controller->$controllerMethod());
            echo $data;
            exit();
        }
        catch(Exception $ex)
        {
            Context::Log('file','page_errors_'.date('Y.d.m'))->log($ex->getMessage());
            exit();
        }

    }
}